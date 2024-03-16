<?php
require_once __DIR__ . '/../inc/navbar.php';
?>


<script type="text/javascript" src="/../clinic/inc/database.js"></script>
<script type="text/javascript" src="/../clinic/inc/consult.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/pt.js"></script>

<style>
    .flatpickr-input {
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        padding: 0.375rem 0.75rem;
    }
</style>


<form action="?rota=consult" method="POST" class="border border-dark rounded w-75 p-3 mx-auto mt-3 row gy-2 gx-3 align-items-center d-flex justify-content-center">
    <div class="col-auto">
        <label class="visually-hidden" for="autoSizingInput">Médico</label>
        <select name="medico" class="form-select" id="autoSizingSelect" required>
            <option selected value="">Médico...</option>
            <?php
            try {
                $db = new database();
                $stmt = $db->query("SELECT m.idMedico, m.nome, e.descricao, e.idEspecialidade FROM medico as m, especialidade as e where e.idEspecialidade=m.idEspecialidade");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value=\"{$row['idMedico']}_{$row['idEspecialidade']}\">{$row['nome']} - {$row['descricao']}</option>" . PHP_EOL;
                }
            } catch (PDOException $e) {
                echo "Erro: " . $e->getMessage();
            }
            ?>
        </select>
    </div>
    <div class="col-auto">
        <label class="visually-hidden" for="autoSizingInput">Paciente</label>
        <select name="paciente" class="form-select" id="autoSizingSelect" required>
            <option selected value="">Paciente...</option>
            <?php
            try {
                $db = new database();
                $stmt = $db->query("SELECT * FROM paciente");
                $value = 1;
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value=\"{$row['idPaciente']}\">{$row['nome']}</option>" . PHP_EOL;
                    $value += 1;
                }
            } catch (PDOException $e) {
                echo "Erro: " . $e->getMessage();
            }
            ?>
        </select>
    </div>
    <div class="col-auto">
        <label class="visually-hidden" for="autoSizingInput">Data</label>
        <input type="text" name="data" id="datetimepicker" placeholder="Data">
    </div>
    <div class="col-auto">
        <button type="submit" name="add_btn" class="btn btn-primary">Adicionar Consulta</button>
    </div>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_btn'])) {
    $id_especialidade = explode("_", $_POST['medico'])[1]; // Separar idMedico e idEspecialidade
    $id_medico = explode("_", $_POST['medico'])[0];
    $db = new database();
    $db->query("INSERT INTO consulta (data,idMedico,idPaciente,idEspecialidade) VALUES (\"{$_POST['data']}\",{$id_medico},{$_POST['paciente']},{$id_especialidade})");
}
?>

<div class="border border-dark rounded w-75 p-3 mx-auto mt-3 mb-5 table-responsive">
    <table id="tabelaMain" class="display responsive" style="width:100%;">
        <thead>
            <tr>
                <th>Médico</th>
                <th>Paciente</th>
                <th>Especialidade</th>
                <th>Data de Consulta</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            try {
                $db = new database();
                $stmt = $db->query("SELECT c.*, m.nome AS nome_medico, p.nome AS nome_paciente, e.descricao AS descricao_especialidade, e.preco
                        FROM consulta AS c 
                        JOIN medico AS m ON c.idMedico = m.idMedico 
                        JOIN paciente AS p ON c.idPaciente = p.idPaciente 
                        JOIN especialidade AS e ON c.idEspecialidade = e.idEspecialidade");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                        <td>{$row['nome_medico']}</td>
                        <td>{$row['nome_paciente']}</td>
                        <td>{$row['descricao_especialidade']}</td>
                        <td>{$row['data']}</td>
                        <td>{$row['preco']} €</td>
                        <td>
                        <a type='button' style='color: black;' class='editBtn me-2' data-bs-toggle='modal' data-bs-target='#editModal' data-id='{$row['idConsulta']}' data-especialidade='{$row['descricao_especialidade']}' data-medico='{$row['nome_medico']}' data-paciente='{$row['nome_paciente']}' data-data='{$row['data']}''><i class='fa-solid fa-user-pen fa-lg'></i></a>
                            <a type='button' style='color: black;' onclick='ativa({$row['idConsulta']})' class='deleteBtn' data-bs-toggle='modal' data-bs-target='#exampleModal' name='del_btn'><i class='fa-solid fa-trash fa-lg'></i></a>
                        </td>
                    </tr>";
                }
            } catch (PDOException $e) {
                echo "Erro: " . $e->getMessage();
            }
            ?>

        </tbody>
    </table>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tem a certeza que deseja eliminar o registo?</h1>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <a type="button" class="btn btn-primary" id="saveChangesBtn">Apagar</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Consulta</h5>
            </div>
            <div class="modal-body">
                <form action="/../clinic/inc/editcon.php" method="post">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Médico:</label>
                        <select class="form-select" id="edit_medico" name="medico" required>
                            <?php
                            try {
                                $db = new database();
                                $stmt = $db->query("SELECT m.idMedico, m.nome, e.descricao, e.idEspecialidade FROM medico as m, especialidade as e where e.idEspecialidade=m.idEspecialidade");
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value='{$row['idMedico']}'>{$row['nome']} - {$row['descricao']}</option>";
                                }
                            } catch (PDOException $e) {
                                echo "Erro: " . $e->getMessage();
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="paciente" class="form-label">Paciente:</label>
                        <select class="form-select" id="edit_paciente" name="paciente" required>
                            <?php
                            try {
                                $db = new database();
                                $stmt = $db->query("SELECT * FROM paciente");
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value=\"{$row['idPaciente']}\">{$row['nome']}</option>" . PHP_EOL;
                                }
                            } catch (PDOException $e) {
                                echo "Erro: " . $e->getMessage();
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="data" class="form-label">Data:</label>
                        <input type="text" class="form-label" id="datetimepicker" name="data" required>
                    </div>
                    <input type="hidden" id="edit_consulta_id" name="consulta_id">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    flatpickr("#datetimepicker", {
        enableTime: true, // Habilita a seleção de hora
        dateFormat: "Y-m-d H:i", // Formato da data e hora
        minDate: "today",
        locale: "pt",
    });
</script>