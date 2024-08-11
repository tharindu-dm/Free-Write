<?php
class App
{
    private $controller = 'HomeController'; //these values will be changed by the URL
    private $method = 'index';

    
    //show(splitURL());

    public function loadController()
    {
        $URL = splitURL(); //accessing whats after  /Free-Write/public/____
        //show( $URL);
        $filename = "../app/controllers/" . ucfirst($URL[0]) . "Controller.php";

        if (file_exists($filename)) {
            require $filename; //by requiring the file, we can now use the class
            $this->controller = $URL[0]."Controller"; //changing the current controller
        } else {
            $filename = "../app/controllers/Error.php";
            require $filename;
            $this->controller = "Error";
        }

        $controller = new $this->controller; //creating a new instance of the controller to use its methods
        call_user_func_array([$controller, $this->method],[]); //calling the method of the controller
    }
}
