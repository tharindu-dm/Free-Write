<?php

require_once '../config/database.php';
require_once '../controllers/UserController.php';
require_once '../models/User.php';

$db = new PDO($dsn, $username, $password);
$userModel = new User($db);
$userController = new UserController($userModel);

$route = $_SERVER['REQUEST_URI'];

switch ($route) {
    case '/login':
        $userController->showLoginForm();
        break;
    case '/dashboard':
        // Assuming you have a DashboardController
        $dashboardController->index();
        break;
    // Add more routes as needed
    default:
        // 404 page or redirect to home
        break;
}