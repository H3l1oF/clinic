<?php

require_once __DIR__ . "/../inc/database.php";
require_once __DIR__ . "/../inc/header.php";

    try {
        $db = new database();
        $gg = $db->query("SELECT COUNT(*) FROM consulta WHERE idMedico = " . $_GET["idMedico"]);
    
        $count = $gg->fetchColumn();
        if ($count > 0) {
            echo '
            <div classs="container p-5">
        <div class="row no-gutters">
            <div class="col-lg-2 col-md-12 mx-auto">
                <div class="alert alert-danger shadow my-3" role="alert" style="border-radius: 3px">
                    <div class="text-center">
                        <svg width="3em" height="3em" viewBox="0 0 16 16" class="m-1 bi bi-exclamation-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                        </svg>
                    </div>
                    <p style="font-size:18px" class="mb-0 font-weight-light text-center"><b class="mr-1">Erro! </b>O Médico tem consultas efetuadas.</p>
                    <div class="align-items-center d-flex justify-content-center mt-4">
                        <button type="button" id="btnBack" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
                    </div>
                </div>
            </div>
        </div>
                ';
        } else {
        $db = new database();
        $stmt = $db->query("DELETE FROM medico WHERE idMedico =" . $_GET["idMedico"]);
        header("Location: /../clinic/public/?rota=doctor");
        exit; 
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>
<script>
document.getElementById("btnBack").addEventListener("click", function() {
    window.location.href = "/../clinic/public/?rota=doctor";
});
</script>