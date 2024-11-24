<?php

//this spl_autoload_register function will automatically include the class file when it is called
spl_autoload_register(function($classname){
    require __DIR__."/../models/".ucfirst($classname).".php";
});

require __DIR__."/../config/database.php"; //run the database connection file

//load the following file for the application to work
require "functions.php";
require "config.php";
require "Model.php";
require "Controller.php";
require "App.php"; 