<?php

class UserController extends Controller
{
    public function index()
    {
        //echo "this is the User Controller";
        $URL = splitURL();

        if ($URL[1] == 'handleLogin') {
            //echo "this is the handleLogin function";
            $this->handleLogin();
        }

        if ($URL[2] == 'login') {
            switch ($URL[3]) {
                case 'login':
                    //echo "this is the login function";
                    $this->login();
                    break;
                case 'register':
                    //echo "this is the register function";
                    $this->register();
                    break;
                case 'inst':
                    //echo "this is the institution login function";
                    $this->inst();
                    break;
                default:
                    //echo "this is the default function";
                    $this->view('login');
                    break;
            }
        }
    }

    //add a login validation thing, and create the session, and view the relevant page. utilize the read function below
    public function handleLogin()
    {

        //echo "inside the handleLogin function";
        // Start the session if it's not already started
        if (session_status() == PHP_SESSION_NONE) {

            //echo "session is not started";
            session_start();
        }

        // Checking if user is already logged in
        if (isset($_SESSION['user_id'])) {
            //echo "user is already logged in";
            ////////////////////////////check the user type efore redirecting (admin, mod, reader, writer, covdes, wricov, courier, publisher, inst)
            switch ($_SESSION['user_type']) {
                case 'admin':
                    header('Location: /admin');
                    break;
                case 'mod':
                    header('Location: /mod');
                    break;
                case 'reader':
                    header('Location: /reader');
                    break;
                case 'writer':
                    header('Location: /writer');
                    break;
                case 'covdes':
                    header('Location: /covdes');
                    break;
                case 'wricov':
                    header('Location: /wricov');
                    break;
                case 'courier':
                    header('Location: /courier');
                    break;
                case 'publisher':
                    header('Location: /publisher');
                    break;
                case 'inst':
                    header('Location: /inst');
                    break;
                default:
                    header('Location: /');
                    break;
            }
            exit;
        } else {
            //echo "user is not logged in";
            $this->view('login');
        }
    }

    /*
        parameters include the username and password and stuff
        perform the insert in user.php
        change the interface to login page
    */
    public function register()
    {
        //echo "inside the register function";
        $URL = splitURL();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //echo "inside the post request";
            $user = new User();
            $user->create($_POST);
            $this->view('login');
        } else {
            //echo "inside the get request";
            $this->view('login');
        }
    }

    public function read()
    {
        //use user.php and return 1 row
    }

    public function update($id)
    {

    }

    public function delete($id)
    {

    }
}