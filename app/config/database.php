<?php

trait Database
{
    private function connect() //connecting to azure sql server
    {
        try {
            $conn = new PDO("sqlsrv:server = tcp:freewrite-server.database.windows.net,1433; Database = Freewrite_db", "CloudSAbf7941bd", "7d9UCx9jTxhk");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e) {
            print("Error connecting to SQL Server.");
            die(print_r($e));
        }
        
        // SQL Server Extension Sample Code:
        $connectionInfo = array("UID" => "CloudSAbf7941bd", "pwd" => "7d9UCx9jTxhk", "Database" => "Freewrite_db", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
        $serverName = "tcp:freewrite-server.database.windows.net,1433";
        $conn = sqlsrv_connect($serverName, $connectionInfo);
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