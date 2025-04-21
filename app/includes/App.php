<?php
class App
{
    private $controller = 'HomeController';
    private $method = 'index';

    public function loadController()
    {
        $URL = splitURL();
        $filename = "../app/controllers/" . ucfirst($URL[0]) . "Controller.php";

        if (file_exists($filename)) {
            require $filename;
            $this->controller = ucfirst($URL[0]) . "Controller";

            // Check if a method is specified in the URL
            if (isset($URL[1])) {
                if (method_exists($this->controller, $URL[1])) {
                    $this->method = $URL[1];
                }
            }
        } else {
            $filename = "../app/controllers/ErrorController.php";//shows the error page
            require $filename;
            $this->controller = "ErrorController";
            $this->method = "notFound";  // Assume we have a not Found method in ErrorController
        }

        $controller = new $this->controller();

        // Extract parameters from the URL (everything after the method name)
        $params = array_slice($URL, 2);

        if (method_exists($controller, $this->method)) {
            call_user_func_array([$controller, $this->method], $params);
        } else {
            // Fallback to index method if the specified method doesn't exist
            call_user_func_array([$controller, 'index'], []);
        }
    }
}