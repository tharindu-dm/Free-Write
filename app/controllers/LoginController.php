<?php

class LoginController extends Controller
{
    public function index()
    {
        //echo "this is the User Controller\n";
        $URL = splitURL();

        if (count($URL) == 2) {
            switch ($URL[1]) {
                case 'handleLogin':
                    $this->handleLogin();
                case 'login':
                    $this->login();
                    break;
                case 'register':
                    $this->register();
                    break;
                case 'logout':
                    $this->logout();
                    break;
                default:
                    $this->view('login');
                    break;
            }
        } else {
            $this->view('login');
        }
    }

    //set expire
    //set login attempt counter
    //set logging login time
    //set site logs

    public function handleLogin()
    {
        if (session_status() == PHP_SESSION_NONE) {

            echo "session is not started\n";
            session_start();
        }

        // Checking if user is already logged in
        if (isset($_SESSION['user_id'])) {
            echo "user is already logged in \n";

            switch ($_SESSION['user_type']) {
                case 'admin':
                    header('Location: /Free-Write/public/Admin');
                    break;
                case 'mod':
                    header('Location: /Free-Write/public/Mod');
                    break;
                case 'reader':
                case 'writer':
                case 'covdes':
                case 'wricov':
                    header('Location: /Free-Write/public/User/profile');
                    break;
                case 'courier':
                    header('Location: /Free-Write/public/courier');
                    break;
                case 'publisher':
                    header('Location: /Free-Write/public/publisher');
                    break;
                case 'inst':
                    header('Location: /Free-Write/public/inst');
                    break;
                default:
                    header('Location: /Free-Write/public/');
                    break;
            }
            exit;
        }/* else {
        //echo "user is not logged in";
        $this->view('login');
    }*/
    }

    /*
        parameters include the username and password and stuff
        perform the insert in user.php
        change the interface to login page
    */

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //echo "inside the post request\n";
            $user = new User();
            $userDetails = new UserDetails();

            $result = $user->createUser($_POST['signup-email'], $_POST['pw'], "reader", 0, 1);



            if ($result) {
                $newUserID = $user->getUserByUsername($_POST['signup-email']);
                $regDate = date("Y-m-d H:i:s");
                $result = $userDetails->addUserDetails($newUserID["userID"], $_POST['fname'], $_POST['lname'], $regDate, $regDate);

                if ($result) {
                    echo "User details created successfully!\n";
                } else {
                    echo "<script>alert('Failed to create user details')</script>";
                }
            } else {
                echo "<script>alert('Failed to create user')</script>";
            }

            $this->view('login');
        } else {
            //echo "inside the get request";
            $this->view('login');
        }
    }

    public function login()
    {
        //echo "inside the login function\n";
        //$URL = splitURL();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //echo "inside the post request\n";
            $user = new User();
            $userData = $user->getUserByUsername($_POST['log-email']);
            show($userData);

            $pw = $_POST['log-password'];

            if ($userData) {
                if ($pw == $userData['password']) {
                    echo "<script> alert('Password is correct!'); </script>";
                    // Start the session if it's not already started
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }

                    // Set session variables
                    $_SESSION['user_id'] = $userData['userID'];
                    $_SESSION['user_type'] = $userData['userType'];

                    // Redirect to the appropriate page based on user type
                    $this->handleLogin();
                    exit;
                } else {
                    echo "Password is incorrect.";
                }
            } else {
                echo "User not found.";
            }

            $this->view('login');
        } else {
            //echo "inside the get request";
            $this->view('login');
        }
    }

    public function logout()
    {
        //echo "inside the logout function\n";
        // Start the session if it's not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Unset all of the session variables
        $_SESSION = array();

        // Destroy the session
        session_destroy();

        // Redirect to the login page
        header('Location: /Free-Write/public/');
        exit;
    }

    public function userProfile()
    {
        echo "inside the userProfile function\n";
        $this->view('userProfile');
    }
}
