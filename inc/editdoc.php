<?php

require_once __DIR__ . "/../inc/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['medico_id'];
    $nome = $_POST['nome'];
    $especialidade = $_POST['especialidade'];

    try {
        $db = new database();
        $stmt = $db->query("UPDATE medico SET nome = '$nome', idEspecialidade = $especialidade WHERE idMedico = $id");
        $db = null;
        $stmt = null;
        header("Location: /../clinic/public/?rota=doctor");
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
} else {
    echo "Erro: Os dados do formulário não foram recebidos corretamente!";
}
?>