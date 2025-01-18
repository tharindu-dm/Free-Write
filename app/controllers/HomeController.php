<?php

class HomeController extends Controller
{
    public function index()
    {
        //echo "this is the Home Controller\n";
        //$this->checkLoggedUser();
        $this->view("home"); //calling the view function in /includes/Controller.php to view the homepage
    }

    public function About()
    {
        $this->view("AboutUs");
    }

    public function Terms_of_Service()
    {
        $this->view("TOS");
    }

    public function Privacy_Policy()
    {
        $this->view("PrivacyPolicy");
    }

}

