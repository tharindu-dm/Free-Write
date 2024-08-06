<?php

class HomeController extends Controller
{
    public function index()
    {
        //echo "this is the Home Controller";
        $this->view("home");
    }
}