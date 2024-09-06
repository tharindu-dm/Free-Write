<?php

class Controller
{
    public function view($name) //to load the view file dynamically
    {
        $filename = "../app/views/";
        switch ($name) {
            case "adminDashboard":
                $filename .= "admin/" . $name;
                break;
            default:
                $filename .= $name;
        }
        $filename .= ".php";

        if (file_exists($filename)) {
            require $filename;
        } else {
            $filename = "../app/views/error.php";
            require $filename;
        }
    }
}