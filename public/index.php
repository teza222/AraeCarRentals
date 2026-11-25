
<?php

session_start();

require_once __DIR__ . '/../app/Controllers/HomeController.php';
require_once __DIR__ . '/../app/Controllers/AuthController.php';

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

    case 'home':
    default:
        $controller = new HomeController();
        $controller->index();
        break;
}
