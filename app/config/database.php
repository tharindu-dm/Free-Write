<?php

function show($stuff)
{
    echo "<pre>";
    print_r($stuff);
    echo "</pre>";
}


$dsn = 'mysql:host=free-write-db.c5eaayaii022.eu-north-1.rds.amazonaws.com;dbname=freewrite-db;charset=utf8mb4';
$username = 'admin';
$password = '5xIQI2XQaZZh9nzP';

try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}
