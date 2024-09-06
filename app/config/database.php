<?php

trait Database
{
    private function connect() //connecting to azure sql server
    {
        try {
            $conn = new PDO("sqlsrv:server = tcp:freewrite-server.database.windows.net,1433; Database = Freewrite_db", "CloudSAbf7941bd", "7d9UCx9jTxhk");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }
        catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function query($query, $data = []) //using sql prepared statement to avoid sql injections
    {
        $con = $this->connect();
        $statement = $con->prepare($query);

        $check = $statement->execute($data);
        if ($check) {
            // For SELECT queries, fetch results
            if (stripos($query, 'SELECT') === 0) {
                return $statement->fetchAll(PDO::FETCH_ASSOC);
            } else {
                // For non-SELECT queries, return true/false based on execution
                return $check;
            }
        } else {
            // Handle errors if query fails
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
            echo "Query failed\n";
            return false;
        }
    }
}