<?php
require_once __DIR__ . '/../inc/navbar.php';
?>

<script type="text/javascript" src="/../clinic/inc/database.js"></script>
<script type="text/javascript" src="/../clinic/inc/patient.js"></script>

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

<form action="?rota=pat" method="POST" class="border border-dark rounded w-75 p-3 mx-auto mt-3 row gy-2 gx-3 align-items-center d-flex justify-content-center">
    <div class="col-auto">
        <label class="visually-hidden" for="autoSizingInput">Nome</label>
        <input type="text" name="nome" class="form-control" id="autoSizingInput" placeholder="Nome" required>
    </div>
    <div class="col-auto">
        <label class="visually-hidden" for="autoSizingInput">Localidade</label>
        <input type="text" name="localidade" class="form-control" id="autoSizingInput" placeholder="Localidade" required>
    </div>
    <div class="col-auto">
        <label class="visually-hidden" for="autoSizingInput">Contacto</label>
        <input type="number" name="contacto" class="form-control" id="autoSizingInput" placeholder="Contacto Telefónico" required>
    </div>
    <div class="col-auto">
        <label class="visually-hidden" for="autoSizingInput">Data de Nascimento</label>
        <input type="text" id="datetimepicker" name="data" placeholder="Data de Nascimento" required>
    </div>
    <div class="col-auto">
        <button type="submit" name="add_btn" class="btn btn-primary">Adicionar Paciente</button>
    </div>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_btn'])) {
    $db = new database();
    $db->query("INSERT INTO paciente (nome,localidade,contacto,dataNasc) VALUES (\"{$_POST['nome']}\",\"{$_POST['localidade']}\",{$_POST['contacto']},\"{$_POST['data']}\")");
}
?>

<div class="border border-dark rounded w-75 p-3 mx-auto mt-3 mb-5 table-responsive">
    <table id="tabelaMain" class="display responsive" style="width:100%;">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Localidade</th>
                <th>Contacto</th>
                <th>Data de Nascimento</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            try {
                $db = new database();
                $stmt = $db->query("SELECT * FROM paciente");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                        <td>{$row['nome']}</td>
                        <td>{$row['localidade']}</td>
                        <td>{$row['contacto']}</td>
                        <td>{$row['dataNasc']}</td>
                        <td>
                            <a type='button' style='color: black;' class='editBtn me-2' data-bs-toggle='modal' data-bs-target='#editModal' data-id='{$row['idPaciente']}' data-nome='{$row['nome']}' data-contacto='{$row['contacto']}' data-data='{$row['dataNasc']}' data-localidade='{$row['localidade']}'><i class='fa-solid fa-user-pen fa-lg'></i></a>
                            <a type='button' style='color: black;' onclick='ativa({$row['idPaciente']})' class='deleteBtn' data-bs-toggle='modal' data-bs-target='#exampleModal' name='del_btn'><i class='fa-solid fa-trash fa-lg'></i></a>
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
                <h5 class="modal-title" id="editModalLabel">Editar Paciente</h5>
            </div>
            <div class="modal-body">
                <form action="/../clinic/inc/editpat.php" method="post">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome:</label>
                        <input type="text" class="form-control" id="edit_nome" name="nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="localidade" class="form-label">Localidade:</label>
                        <input type="text" class="form-control" id="edit_localidade" name="localidade" required>
                    </div>
                    <div class="mb-3">
                        <label for="contacto" class="form-label">Contacto:</label>
                        <input type="number" class="form-control" id="edit_contacto" name="contacto" required>
                    </div>
                    <div class="mb-3">
                        <label for="data" class="form-label">Data de Nascimento:</label>
                        <input type="date" class="form-control" id="datetimepicker" name="data" required>
                    </div>
                    <input type="hidden" id="edit_paciente_id" name="paciente_id">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </form>
            </div>
        </div>
    </div>
</div>´

<script>
    flatpickr("#datetimepicker", {
        enableTime: false,
        dateFormat: "Y-m-d",
        locale: "pt",
        maxDate: "today",
        theme: "material_blue"
    });
</script>