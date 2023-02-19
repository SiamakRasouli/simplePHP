<?php

namespace System\Core;

class Router
{
    protected $routes = [];

    public function get($uri, $controller) {
        $this->bind('GET', $uri, $controller);
    }
    
    public function post($uri, $controller) {
        $this->bind('POST', $uri, $controller);
    }

    public function delete($uri, $controller) {
        $this->bind('DELETE', $uri, $controller);
    }
    
    public function patch($uri, $controller) {
        $this->bind('PATCH', $uri, $controller);
        
    }
    
    public function put($uri, $controller) {
        $this->bind('PUT', $uri, $controller);
    }

    public function bind($method, $uri, $controller, $action = 'index') {
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'action' => $action,
        ];
    }

    public function run(){
        $requestURI = parse_url($_SERVER['REQUEST_URI']);
        $method = isset($_GET['_method']) ? $_GET['_method'] : $_SERVER['REQUEST_METHOD'];

        $callback = null;
        foreach($this->routes as $route) {
            if($requestURI['path'] === $route['uri'] && $method == $route['method']) {
                $callback = $route;
            }
        }

        if($callback === NULL) abort();
        return call_user_func($this->checkCallback($callback['controller']));
    }

    protected function checkCallback($callback){
        if(is_array($callback)) {
            return [new $callback[0], $callback[1]];
        }
            return $callback;
    }
}
