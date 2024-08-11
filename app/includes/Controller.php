<?php

class Controller
{
    public function view($name) //to load the view file dynamically
    {
        $filename ="/Free-Write/app/views/" . $name . ".php";
        
        if (file_exists($filename)) {
            require $filename;
        } else {
            $filename = "/Free-Write/app/views/error.php";
            require $filename;
        }
    }
}