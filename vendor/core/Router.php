<?php

namespace vendor\core;
/**
 * Created by PhpStorm.
 * User: asus-pc
 * Date: 16.05.2017
 * Time: 16:31
 */
class Router
{

    protected static $routes = [];
    protected static $route = [];

    public static function add($regExp, $route = [])
    {
        self::$routes[$regExp] = $route;
    }


    /**
     * @return array
     */
    public static function getRoutes()
    {
        return self::$routes;
    }

    public static function getRoute()
    {
        return self::$route;
    }



    /**
     * Looks for matches $url in routes
     * @param string $url - entered URL
     * @return bool
     */
    protected static function matchRoute($url)
    {
        foreach (self::$routes as $pattern => $route)
        {
            if(preg_match("#$pattern#i", $url, $matches))
            {
                foreach ($matches as $key => $value)
                {
                    if(is_string($key))
                    {
                        $route[$key] = $value;
                    }
                }
                if(!isset($route['action']))
                {
                    $route['action'] = 'index';
                }
                $route['controller'] = self::upperCamelCase($route['controller']);
                $route['action'] = self::upperCamelCase($route['action']);
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    /**
     * Redirects URL to the right route(way)
     * @param string $url - entered URL
     */
    public static function dispatch($url)
    {
        $url = self::removeQueryString($url);
        if(self::matchRoute($url))
        {
            $controller = 'app\controllers\\' . self::$route['controller'] . 'Controller';
            if(class_exists($controller))
            {
                $cObj = new $controller(self::$route);
                //$action = self::lowerCamelCase(self::$route['action']) . 'Action';
                $action = 'action' . self::$route['action'];
                if(method_exists($cObj, $action))
                {
                    $cObj->$action();
                    $cObj->getView();
                }
                else
                {
                    echo "Метод <b>$controller::$action</b> не найден";
                }
            }
            else
            {
                echo "Контрллер <b>$controller</b> не найден";
            }
        }
        else
        {
            http_response_code(404);
            include '404.html';
        }
    }


    protected static function upperCamelCase($name)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
    }

//    protected static function lowerCamelCase($name)
//    {
//        return  lcfirst(str_replace(' ', '', ucwords(str_replace('-', ' ', $name))));
//    }

    protected static function removeQueryString($url)
    {
        if($url)
        {
            $params = explode('&', $url, 2);
            if(strpos($params[0], '=') === false)
            {
                return rtrim($params[0], '/');
            }
            else
            {
                return '';
            }
        }
    }
}






