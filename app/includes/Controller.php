<?php

class Controller
{
    public function view($name) //to load the view file dynamically
    {
        $filename ="../app/views/" . $name . ".php";
        
        if (file_exists($filename)) {
            require $filename;
        } else {
            $filename = "../app/views/error.php";
            require $filename;
        }
    }
}