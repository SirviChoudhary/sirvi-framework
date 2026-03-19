<?php
namespace App\Core;

class Env{
    protected static $variables = [];
    public static function load($path){
        if(!file_exists($path)){
            throw new \Exception(".env file not found at: " . $path);
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        // echo "<pre>";
        // print_r($lines);
        // echo "</pre>";

        foreach($lines as $line){
            if(strpos(trim($line), '#') === 0){
                continue;
            }

            list($key, $value) = explode('=', $line, 2);

            $key = trim($key);
            $value = trim($value);

            self::$variables[$key] = $value;

            $_ENV[$key] = $value;
        }

    }
    
    public static function get($key, $default = null){
        return self::$variables[$key] ?? $default;
    }
}
?>