<?php

require_once __DIR__ . "/../inc/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['consulta_id'];
    $medico = $_POST['medico'];
    $paciente = $_POST['paciente'];
    $data = $_POST['data'];
    echo $id . PHP_EOL;
    echo $medico . PHP_EOL;
    echo $paciente . PHP_EOL;
    echo $data . PHP_EOL;

    $db = new database();
    // Consulta para obter a especialidade do médico
    $stmt = $db->query("SELECT m.idMedico, m.idEspecialidade, e.descricao AS especialidade 
                        FROM medico AS m 
                        INNER JOIN especialidade AS e ON m.idEspecialidade = e.idEspecialidade 
                        WHERE m.idMedico = $medico");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $idEspecialidade = $row['idEspecialidade'];
    echo $idEspecialidade;
   try {
        $db = new database();
        $stmt = $db->query("UPDATE consulta SET data = '$data', idMedico = $medico, idPaciente = $paciente, idEspecialidade = $idEspecialidade  WHERE idConsulta = $id");
        $db = null;
        $stmt = null;
        header("Location: /../clinic/public/?rota=consult");
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
} else {
    echo "Erro: Os dados do formulário não foram recebidos corretamente!";
}
?>