<?php

class HomeController extends Controller
{
    function show($stuff)
    {
        echo "<pre>";
        print_r($stuff);
        echo "</pre>";
    }    

    public function index()
    {
        //echo "this is the Home Controller";
        $user = new User;

        $result = $user->findAll();

        $this->view("home");
    }
}