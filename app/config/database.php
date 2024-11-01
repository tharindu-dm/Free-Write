<?php

trait Database
{
    private function loadEnv($filePath)
    {
        if (file_exists($filePath)) {
            $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                // Skip comments
                if (strpos(trim($line), '#') === 0) {
                    continue;
                }
                // Split by '=' and trim whitespace
                list($key, $value) = explode('=', $line, 2);
                $key = trim($key);
                $value = trim($value);
                // Set the environment variable
                putenv("$key=$value");
            }
        }
    }

    private function connect() //connecting to azure sql server
    {
        // Load the .env file using the method
        $this->loadEnv(__DIR__ . '/.env');

        // Now you can access the environment variables
        $dsn = getenv('DB_DSN');
        $username = getenv('DB_USERNAME');
        $password = getenv('DB_PASSWORD');

        try {
            $conn = new PDO($dsn, $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
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
        $con = $this->connect(__DIR__ . '/.env');
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