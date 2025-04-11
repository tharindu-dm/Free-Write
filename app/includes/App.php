<?php
class App
{
    private $controller = 'HomeController';
    private $method = 'index';
    private $params = []; // Array to hold parameters

    public function loadController()
    {
        $URL = splitURL(); // Split the URL into parts
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

            // Extract parameters from the URL (if any)
            $this->params = array_slice($URL, 2); // Parameters start from the 3rd part of the URL
        } else {
            $filename = "../app/controllers/ErrorController.php"; // Show the error page
            require $filename;
            $this->controller = "ErrorController";
            $this->method = "notFound"; // Assume we have a notFound method in ErrorController
        }

        $controller = new $this->controller();

        if (method_exists($controller, $this->method)) {
            // Pass parameters to the controller method
            call_user_func_array([$controller, $this->method], $this->params);
        } else {
            // Fallback to index method if the specified method doesn't exist
            call_user_func_array([$controller, 'index'], []);
        }
    }
}