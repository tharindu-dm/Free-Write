<?php

trait Database
{
    private function loadEnv($filePath)
    {
        if (file_exists($filePath)) {
            $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                if (strpos(trim($line), '#') === 0) {
                    continue;
                }
                $parts = explode('=', $line, 2);
                if (count($parts) === 2) {
                    $key = trim($parts[0]);
                    $value = trim($parts[1]);
                    putenv("$key=$value");
                } else {
                    error_log("Invalid line in .env file: '$line'");
                }
            }
        }
    }

    /*  private function connect() //connecting to azure sql server
      {
                    $this->loadEnv(__DIR__ . '/.env');

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
       */

    private function connect()
    {
        $this->loadEnv(__DIR__ . '/.env');

        $host = getenv('DB_HOST');
        $dbname = getenv('DB_NAME');
        $dsn = "sqlsrv:Server=$host;Database=$dbname";
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
    public function query($query, $data = [])
    {
        $con = $this->connect();
        $statement = $con->prepare($query);
        $check = $statement->execute($data);
        if ($check) {
            if (stripos($query, 'SELECT') === 0) {
                return $statement->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return $check;
            }
        } else {
            return false;
        }
    }
}