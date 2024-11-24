<?php

class Controller
{
    public function view($name, $data = []) //to load the view file dynamically
    {
        $filename = "../app/views/";
        $filename .= $name . ".php";

        if (file_exists($filename)) {
            extract($data);
            require $filename;
        } else {
            $filename = "../app/views/error.php";
            require $filename;
        }
    }
}