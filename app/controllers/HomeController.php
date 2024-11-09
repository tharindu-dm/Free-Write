<?php

class HomeController extends Controller
{
    public function index()
    {
        //echo "this is the Home Controller\n";
        //$this->checkLoggedUser();
        $this->view("home"); //calling the view function in /includes/Controller.php to view the homepage
    }

    private function checkLoggedUser()
    {
        if (session_status() == PHP_SESSION_NONE) {
           echo "no session found";
        }

        if (isset($_SESSION['user_id'])) {
            echo "user is already logged in \n";
        }
    }
}