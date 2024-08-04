<?php
require_once 'models/User.php';

class UserController {
    private $db;
    private $user;

    public function __construct($db) {
        $this->db = $db;
        $this->user = new User($db);
    }

    public function showLoginForm() {
        require 'views/user/login.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $this->user->authenticate($username, $password);

            if ($user) {
                // Start session and set user data
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                
                // Redirect to dashboard or home page
                header('Location: /dashboard');
                exit;
            } else {
                $error = "Invalid username or password";
                require 'views/user/login.php';
            }
        } else {
            $this->showLoginForm();
        }
    }
}