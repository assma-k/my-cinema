<?php
require("autoload.php");

class RouterException extends Exception {}

class router
{
    private $url;
    private $routes;
    private $db;

    public function __construct($url, $db)
    {
        $this->url = $url;
        $this->db = $db;
    }

    public function get($path, $callable)
    {
        $routes = new route($path, $callable);
        $this->routes["GET"][] = $routes;
        return $routes;
    }
    public function post($path, $callable)
    {
        $routes = new route($path, $callable);
        $this->routes['POST'][] = $routes;
        return $routes;
    }

    public function run()
    {
        if (!isset($this->routes[$_SERVER['REQUEST_METHOD']])) {
            throw new RouterException('REQUEST_METHOD does not exist');
        }
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if ($route->match($this->url)) {
                return $route->call($this->db);
            }
        }
        throw new RouterException('No matching routes');
    }
}
