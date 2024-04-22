<?php
require_once __DIR__ . '/../inc/navbar.php';
?>

<script type="text/javascript" src="/../clinic/inc/database.js"></script>
<script type="text/javascript" src="/../clinic/inc/spec.js"></script>

<form action="?rota=spec" method="POST" class="border border-dark rounded w-75 p-3 mx-auto mt-3 row gy-2 gx-3 align-items-center d-flex justify-content-center">
    <div class="col-auto">
        <label class="visually-hidden" for="autoSizingInput">Especialidade</label>
        <input type="text" name="especialidade" class="form-control" id="autoSizingInput" placeholder="Especialidade" required>
    </div>
    <div class="col-auto">
        <label class="visually-hidden" for="autoSizingInput">Preço</label>
        <input type="number" name="preco" step="0.01" class="form-control" id="autoSizingInput" placeholder="Preço" required>
    </div>
    <div class="col-auto">
        <button type="submit" name="add_btn" class="btn btn-primary">Adicionar Especialidade</button>
    </div>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_btn'])) {
    $db = new database();
    $db->query("INSERT INTO especialidade (descricao,preco) VALUES (\"{$_POST['especialidade']}\",{$_POST['preco']})");
}
?>

<div class="border border-dark rounded w-75 p-3 mx-auto mt-3 mb-5 table-responsive">
    <table id="tabelaMain" class="display responsive" style="width:100%;">
        <thead>
            <tr>
                <th>Especialidade</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            try {
                $db = new database();
                $stmt = $db->query("SELECT * FROM especialidade");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                        <td>{$row['descricao']}</td>
                        <td>{$row['preco']} €</td>
                        <td>
                            <a type='button' style='color: black;' class='editBtn me-2' data-bs-toggle='modal' data-bs-target='#editModal' data-id='{$row['idEspecialidade']}' data-preco='{$row['preco']}' data-especialidade='{$row['descricao']}'><i class='fa-solid fa-user-pen fa-lg'></i></a>
                            <a type='button' style='color: black;' onclick='ativa({$row['idEspecialidade']})' class='deleteBtn' data-bs-toggle='modal' data-bs-target='#exampleModal' name='del_btn'><i class='fa-solid fa-trash fa-lg'></i></a>
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
                <h5 class="modal-title" id="editModalLabel">Editar Especialidade</h5>
            </div>
            <div class="modal-body">
                <form action="/../clinic/inc/editspec.php" method="post">
                    <div class="mb-3">
                        <label for="especialidade" class="form-label">Especialidade:</label>
                        <input type="text" class="form-control" id="edit_especialidade" name="especialidade" required>
                    </div>
                    <div class="mb-3">
                        <label for="preco" class="form-label">Preço:</label>
                        <input type="number" step="0.01" class="form-control" id="edit_preco" name="preco" required>
                    </div>
                    <input type="hidden" id="edit_especialidade_id" name="especialidade_id">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </form>
            </div>
        </div>
    </div>
</div>

