<?php

class HomeController extends Controller
{
    public function index()
    {
        //echo "this is the Home Controller";
        $user = new User;

        $this->view("home");
    }
}