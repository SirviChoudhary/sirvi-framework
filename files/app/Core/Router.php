<?php
namespace App\Core;
class Router{

   protected static $routes = [];

    public static function post($uri, $action) {
        self::$routes['POST'][$uri] = $action;
    }

    public static function get($uri, $action) {
    self::$routes['GET'][$uri] = $action;
}

    public function dispatch() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $uri = str_replace('/api', '', $uri);

// var_dump($method);
// var_dump($uri);
// die;

        if(!isset(self::$routes[$method][$uri])){
            http_response_code(404);
            echo json_encode(['error' => 'Route not found']);
            return;
        }

        [$controller, $methodName] = self::$routes[$method][$uri];
        
        call_user_func([new $controller, $methodName]);
    }

}
?>