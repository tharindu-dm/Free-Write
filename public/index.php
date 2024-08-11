<?php
session_start(); //starting an empty session
require "/Free-Write/app/includes/autoload.php"; // Require the autoload.php file to load all the necessary classes and traits while also configuring the database connection.

$app = new App(); // Create a new instance of the App class in app/includes/App.php
$app->loadController(); //loading the necessary controller and method when the user navigates to a page