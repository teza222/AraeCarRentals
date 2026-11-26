<?php

ob_start();

error_reporting(E_ALL);
ini_set('display_errors', '1');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../app/Controllers/HomeController.php';
require_once __DIR__ . '/../app/Controllers/AuthController.php';
require_once __DIR__ . '/../app/Controllers/VehicleController.php';

$page = $_GET['page'] ?? 'home';

switch ($page) {

    case 'register':
        $controller = new AuthController();
        $controller->register();
        break;

    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;

    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;

    case 'vehicles':
        $controller = new VehicleController();
        $controller->index();
        break;

    case 'vehicle-create':
        $controller = new VehicleController();
        $controller->create();
        break;
    case 'vehicle-delete':
        $controller = new VehicleController();
        $controller->delete();
        break;

    case 'home':
    default:
        $controller = new HomeController();
        $controller->index();
        break;
}