<?php
class App
{
    private $controller = 'HomeController';
    private $method = 'index';

    
    //show(splitURL());

    public function loadController()
    {
        $URL = splitURL();
        //show( $URL);
        $filename = "../app/controllers/" . ucfirst($URL[0]) . "Controller.php";

        if (file_exists($filename)) {
            require $filename;
            $this->controller = $URL[0]."Controller";
        } else {
            $filename = "../app/controllers/Error.php";
            require $filename;
            $this->controller = "Error";
        }

        $controller = new $this->controller;
        call_user_func_array([$controller, $this->method],[]);
    }
}
