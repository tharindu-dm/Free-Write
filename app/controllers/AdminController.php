<?php

class AdminController extends Controller
{
    public function index()
    {
        //echo "this is the Admin Controller\n";
        $URL = splitURL();

        if (count($URL) == 2) {
            switch ($URL[1]) {
                case 'logout':
                    $this->logout();
                    break;
                case 'viewTable':
                    $this->view('adminViewTable');
                    break;
                case 'siteLogs':
                    $this->view('adminSiteLogs');
                    break;
                case 'modLogs':
                    $this->view('adminModLogs');
                    break;
                default:
                    $this->view('adminDashboard');
                    break;
            }

        } else {
            $this->view('adminDashboard');
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
        header('Location: /Free-Write/public/User/login');
        exit;
    }
}