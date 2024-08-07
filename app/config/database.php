<?php

trait Database
{
    function show($stuff)
    {
        echo "<pre>";
        print_r($stuff);
        echo "</pre>";
    }

    private function connect()
    {
        $dsn = 'mysql:host=free-write-db.c5eaayaii022.eu-north-1.rds.amazonaws.com;dbname=freewrite-db;charset=utf8mb4';
        $username = 'admin';
        $password = '5xIQI2XQaZZh9nzP';

        try {
            $con = new PDO($dsn, $username, $password);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->show($con);

            return $con;
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }

    public function query($query, $data = []) //using sql prepared statement to avoid sql injections
    {
        $con = $this->connect();
        $statement = $con->prepare($query);

        $check = $statement->execute($data);
        if ($check) {
            //echo "Query successful";
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            if (is_array($result) && count($result)) {
                return $result;
            }
        } else {
            echo "Query failed";
            return false;
        }
    }
    public function get_row($query, $data = []) //one row 
    {
        $con = $this->connect();
        $statement = $con->prepare($query);

        $check = $statement->execute($data);
        if ($check) {
            //echo "Query successful";
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            if (is_array($result) && count($result)) {
                return $result[0];
            }
        } else {
            echo "Query failed";
            return false;
        }
    }
}