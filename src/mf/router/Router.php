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
        self::$aliases['default'] = array($url);
    }

    public function urlFor($route_name, $param_list=[]) {
        // Do something
    }

    public function run() {
        var_dump($this->http_req->path_info);
        var_dump(self::$routes);
        var_dump(array_key_exists($this->http_req->path_info, self::$routes));

        // if(in_array($this->http_req->path_info, self::$routes)) {
        //     echo true;
        // } else {
        //     echo false;
        // }
    }
}