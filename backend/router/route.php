<?php
class route
{
    private $path;
    private $callable;
    private $matches = [];

    public function __construct($path, $callable)
    {
        $this->path = trim($path, "/");
        $this->callable = $callable;
    }

    public function match($url)
    {
        $url = trim($url, "/");
        $path = preg_replace("#:([\w]+)#", "([^/]+)", $this->path);
        $regex = "#^$path$#i";

        if (!preg_match($regex, $url, $matches)) {
            return false;
        }

        array_shift($matches);
        $this->matches = $matches;
        return true;
    }

    public function call()
    {
        if (is_string($this->callable)) {
            $cont = strtok($this->callable, "@");
            $controller = new $cont();
            $meth = strtok("@");
            return call_user_func_array([$controller, $meth], $this->matches);
        }

        return call_user_func_array($this->callable, $this->matches);
    }
}
