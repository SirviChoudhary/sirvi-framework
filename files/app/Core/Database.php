<?php
namespace App\Core;

class Database{
    private static $connection = null;
    public static function connect(){
    if(self::$connection === null){
        $host = Env::get('DB_HOST','localhost');
        $database = Env::get('DB_DATABASE');
        $username = Env::get('DB_USERNAME');
        $password = Env::get('DB_PASSWORD');

        self::$connection = new \mysqli($host, $username, $password, $database);

        if(self::$connection->connect_error){
            die("Database Connection Failed: " . self::$connection->connect_error);
        }else{
            // echo "Database Connection";
        }
    }
   
    return self::$connection;

    }
}
?>