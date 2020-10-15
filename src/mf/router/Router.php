<?php

namespace mf\router;

class Router extends AbstractRouter {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function addRoute($name, $url, $ctrl, $mth) {
        self::$routes[$url] = array($ctrl, $mth);
        self::$aliases[$name] = array($url);
    }

    public function setDefaultRoute($url) {
        self::$aliases['default'] = $url;
    }

    public function urlFor($route_name, $param_list=[]) {
        // Do something
    }

    public function run() {
        if(array_key_exists($this->http_req->path_info, self::$routes)) {
            $controller = self::$routes[$this->http_req->path_info][0];
            $method = self::$routes[$this->http_req->path_info][1];

            $c = new $controller();
            $c->$method();
        } else {
            $default = self::$aliases['default'];

            $controller = self::$routes[$default][0];
            $method = self::$routes[$default][1];

            $c = new $controller();
            $c->$method();
        }
    }

    public static function executeRoute($route) {
        $aliases = self::$aliases[$route][0];

        $controller = self::$routes[$aliases][0];
        $method = self::$routes[$aliases][1];

        $c = new $controller();
        $c->$method();
    }
}