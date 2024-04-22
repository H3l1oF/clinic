<?php

require_once __DIR__ . "/../inc/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['paciente_id'];
    $nome = $_POST['nome'];
    $localidade = $_POST['localidade'];
    $contacto = $_POST['contacto'];
    $data = $_POST['data'];

    try {
        $db = new database();
        $stmt = $db->query("UPDATE paciente SET nome = '$nome', localidade = '$localidade', contacto = $contacto, dataNasc = '$data' WHERE idPaciente = $id");
        $db = null;
        $stmt = null;
        header("Location: /../clinic/public/?rota=pat");
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
} else {
    echo "Erro: Os dados do formulário não foram recebidos corretamente!";
}
?>