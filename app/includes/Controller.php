<?php

class Controller
{
    public function view($name, $data = [])
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