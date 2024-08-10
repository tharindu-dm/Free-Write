<?php
session_start();
require "/Free-Write/app/includes/autoload.php";

$app = new App();
$app->loadController();