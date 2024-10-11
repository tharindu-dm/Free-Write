<?php

class Controller
{
    public function view($name, $data = []) //to load the view file dynamically
    {
        $filename = "../app/views/";
        switch ($name) {
            case "browse":
            case "designers":
                $filename .= "OpenUser/" . $name;
                break;
            case "adminDashboard":
                $filename .= "admin/" . $name;
                break;
            default:
                $filename .= $name;
        }
        $filename .= ".php";

        if (file_exists($filename)) {
            extract($data);
            require $filename;
        } else {
            $filename = "../app/views/error.php";
            require $filename;
        }
    }
}