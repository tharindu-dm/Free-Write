<?php
session_start();
require "../app/includes/autoload.php";

$app = new App();
$app->loadController();