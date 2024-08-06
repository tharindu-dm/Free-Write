<?php

function show($stuff)
{
    echo "<pre>";
    print_r($stuff);
    echo "</pre>";
}

function splitURL()
{
    $URL = $_GET['url'] ?? 'home';
    $URL = explode('/', $URL);
    return $URL;
}
//show(splitURL());

function loadController($controllerName)
{
    $URL = splitURL();
    $filename = "../app/controllers/".ucfirst($URL[0])."Controller.php";
    if(file_exists($filename))
    {
        require_once $filename;
    }
    else
    {
        echo "File not found";
    }
}