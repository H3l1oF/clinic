<?php


// carregamento das rotas permitidas
$rotas_permitidas = require_once __DIR__ . '/../inc/rotas.php';

// definição da rota
$rota = $_GET['rota'] ?? 'home';


// se a rota não existe
if (!in_array($rota, $rotas_permitidas)) {
    $rota = '404';
}

// preparação da página
$script = null;

switch ($rota) {
    case '404':
        $script .= '404.php';
        break;
    case 'home':
        $script .= 'home.php';
        break;
    case 'doctor':
        $script .= 'doctor.php';
        break;
    case 'spec':
        $script .= 'spec.php';
        break;
    case 'pat':
        $script .= 'patient.php';
        break;
    case 'consult':
        $script .= 'consult.php';
        break;
    case 'contact':
        $script .= 'contact.php';
        break;
}

// carregamento de scripts permanentes
require_once __DIR__ . "/../inc/database.php";

// apresentação da página
require_once __DIR__ . "/../inc/header.php";
require_once __DIR__ . "/../src/$script";
require_once __DIR__ . "/../inc/footer.php";
