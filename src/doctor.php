<?php
require_once __DIR__ . '/../inc/navbar.php';
?>

<script type="text/javascript" src="/../clinic/inc/database.js"></script>
<script type="text/javascript" src="/../clinic/inc/doctor.js"></script>

<form action="?rota=doctor" method="POST" class="border border-dark rounded w-75 p-3 mx-auto mt-3 row gy-2 gx-3 align-items-center d-flex justify-content-center">
    <div class="col-auto">
        <label class="visually-hidden" for="autoSizingInput">Nome</label>
        <input type="text" name="nome" class="form-control" id="autoSizingInput" placeholder="Nome do Médico" required>
    </div>
    <div class="col-auto">
        <label class="visually-hidden" for="autoSizingSelect">Especialidade</label>
        <select name="especialidade" class="form-select" id="autoSizingSelect" required>
            <option selected value="">Especialidade...</option>
            <?php
            try {
                $db = new database();
                $stmt = $db->query("SELECT idEspecialidade, descricao FROM especialidade");
                $value = 1;
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value=\"{$row['idEspecialidade']}\">{$row['descricao']}</option>" . PHP_EOL;
                    $value += 1;
                }
            } catch (PDOException $e) {
                echo "Erro: " . $e->getMessage();
            }
            ?>
        </select>
    </div>
    <div class="col-auto">
        <button type="submit" name="add_btn" class="btn btn-primary">Adicionar Médico</button>
    </div>
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_btn'])) {
    $db = new database();
    $db->query("INSERT INTO medico (nome,idEspecialidade) VALUES (\"{$_POST['nome']}\",{$_POST['especialidade']})");
}
?>

<div class="border border-dark rounded w-75 p-3 mx-auto mt-3 mb-5 table-responsive">
    <table id="tabelaMain" class="display responsive" style="width:100%">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Especialidade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            try {
                $db = new database();
                $stmt = $db->query("SELECT m.idMedico, m.nome, e.descricao FROM medico as m, especialidade as e where e.idEspecialidade=m.idEspecialidade");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                        <td>{$row['nome']}</td>
                        <td>{$row['descricao']}</td>
                        <td>
                            <a type='button' style='color: black;' class='editBtn me-2' data-bs-toggle='modal' data-bs-target='#editModal' data-id='{$row['idMedico']}' data-nome='{$row['nome']}' data-especialidade='{$row['descricao']}'><i class='fa-solid fa-user-pen fa-lg'></i></a>
                            <a type='button' style='color: black;' onclick='ativa({$row['idMedico']})' class='deleteBtn' data-bs-toggle='modal' data-bs-target='#exampleModal' name='del_btn'><i class='fa-solid fa-trash fa-lg'></i></a>
                        </td>
                      </tr>";
                }
                $db = null;
                $stmt = null;
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
                <h5 class="modal-title" id="editModalLabel">Editar Médico</h5>
            </div>
            <div class="modal-body">
                <form action="/../clinic/inc/editdoc.php" method="post">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome:</label>
                        <input type="text" class="form-control" id="edit_nome" name="nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="especialidade" class="form-label">Especialidade:</label>
                        <select class="form-select" id="edit_especialidade" name="especialidade" required>
                            <?php
                            try {
                                $db = new database();
                                $stmt = $db->query("SELECT * FROM especialidade");
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value='{$row['idEspecialidade']}'>{$row['descricao']}</option>";
                                }
                                $db = null;
                                $stmt = null;
                            } catch (PDOException $e) {
                                echo "Erro: " . $e->getMessage();
                            }
                            ?>
                        </select>
                    </div>
                    <input type="hidden" id="edit_medico_id" name="medico_id">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </form>
            </div>
        </div>
    </div>
</div>