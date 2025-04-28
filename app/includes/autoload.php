<?php

spl_autoload_register(function($classname){
    require __DIR__."/../models/".ucfirst($classname).".php";
});

require __DIR__."/../config/database.php"; 

require "functions.php";
require "config.php";
require "Model.php";
require "Controller.php";
require "App.php"; 