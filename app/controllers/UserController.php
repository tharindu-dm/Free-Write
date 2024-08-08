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
    }

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

    public function create()
    {

    }

    public function read()
    {

    }

    public function update($id)
    {

    }

    public function delete($id)
    {

    }
}