<?php
require("autoload.php");

class router {
    private $url;
    private $routes;

    public function __construct($url)
    {
        $this->url =$url;
    }

    public function get($path, $callable)
    {
       $routes = new route($path, $callable);
       $this->routes["GET"][] = $routes;
       return $routes;
    }

    public function run(){
    if(!isset($this->routes[$_SERVER['REQUEST_METHOD']])){
        throw new RouterException('REQUEST_METHOD does not exist');
    }
    foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route){
        if($route->match($this->url)){
            return $route->call();
        }
    }
    throw new RouterException('No matching routes');
}
}