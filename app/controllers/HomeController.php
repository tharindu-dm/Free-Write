<?php

class HomeController extends Controller
{
    public function index()
    {
        //echo "this is the Home Controller\n";
        $user = new User;

        $this->view("home"); //calling the view function in /includes/Controller.php to view the homepage
    }
}