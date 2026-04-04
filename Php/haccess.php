<?php
$url = $_GET['url'] ?? 'home';

switch ($url) {

    case 'home':
        include '../index.php';
        break;

    case 'admin':
        include '../Admin.php';
        break;

    case 'estudiante':
        include '../Homestudent.php';
        break;

    case 'login':
        include '../loginhome.php';
        break;

    case 'register':
        include '../register.php';
        break;

    case 'charla-admin':
        include '../Charla-admin.php';
        break;

    case 'charla-estudiante':
        include '../Charla-estudiante.php';
        break;

    case 'lecciones':
        include '../Lecciones.php';
        break;

    case 'revit':
        include '../Revit.php';
        break;

    case 'ia':
        include '../Inteligenciaartificial.php';
        break;

    default:
        echo "404 - Página no encontrada";
        break;
}