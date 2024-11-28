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
                $parts = explode('=', $line, 2);
                // Check if we have exactly 2 parts
                if (count($parts) === 2) {
                    $key = trim($parts[0]);
                    $value = trim($parts[1]);
                    // Set the environment variable
                    putenv("$key=$value");
                } else {
                    // Handle the case where the line is not a valid key=value pair
                    // You might want to log a warning or error here
                    error_log("Invalid line in .env file: '$line'");
                }
            }
        }
    }

    private function connect() //connecting to azure sql server
    {
        // Load the .env file using the method
        $this->loadEnv(__DIR__ . '/.env');

        // Now can access the environment variables
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

    /*private function connect()
     {
         // Load the .env file using the method
         $this->loadEnv(__DIR__ . '/.env');

         // Define the DSN for SQL Server
         $host = getenv('DB_HOST'); // e.g., "VICTUSTRIX\SQLEXPRESS"
         $dbname = getenv('DB_NAME'); // e.g., "Free-Write"
         $dsn = "sqlsrv:Server=$host;Database=$dbname";
         $username = getenv('DB_USERNAME'); // Use the username or leave empty for Windows Authentication
         $password = getenv('DB_PASSWORD'); // Use the password or leave empty for Windows Authentication

         try {
             $conn = new PDO($dsn, $username, $password);
             $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             return $conn;
         } catch (PDOException $e) {
             die("Connection failed: " . $e->getMessage());
         }
     }
 */

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
    /*public function get_row($query, $data = []) //one row 
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
    }*/
}