<?php

require_once __DIR__ . "/../inc/database.php";


try {
    $db = new database();
    $stmt = $db->query("DELETE FROM consulta WHERE idConsulta =" . $_GET["idConsulta"]);
    $db = null;
    $stmt = null;
    header("Location: /../clinic/public/?rota=consult");
    exit;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>

