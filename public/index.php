<?php

require_once '../config/database.php';
require_once '../controllers/UserController.php';

$db = new PDO($dsn, $username, $password);
$userController = new UserController($db);

$route = $_SERVER['REQUEST_URI'];

switch ($route) {
    case '/login':
        $userController->login();
        break;
    // Other routes...
    default:
        // 404 page or redirect
        break;
}