<?php

<<<<<<< HEAD
date_default_timezone_set('Africa/Nairobi');
=======
date_default_timezone_set('Asia/Kolkata');
>>>>>>> bb8ba0ea7dde2b9d91206291b244a6b946a91dcc

class Database
{
    static function getConnection()
    {
        $dsn ="mysql:host=localhost;dbname=trashproject";
        $username = "root";
        $password = "";
        try
        {
            $conn = new PDO($dsn, $username, $password);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        } catch(PDOException $e) {
            echo "Connection failed: " . var_dump($e->getMessage());
        }

        return $conn;
    }
}
