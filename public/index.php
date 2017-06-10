<?php

    error_reporting(-1);

    use vendor\core\Router;

    $query = rtrim($_SERVER['QUERY_STRING'], '/');

    define('WWW', __DIR__);
    define('ROOT', dirname(__DIR__));
    define('CORE', ROOT . '/vendor/core');
    define('APP', ROOT . '/app');
    define('LAYOUT', 'default');

    require '../vendor/libs/functions.php';
//    require '../app/controllers/Main.php';
//    require '../app/controllers/posts.php';
//    require '../app/controllers/PostsNew.php';

    spl_autoload_register(function($class){
        $file = ROOT . '/' . str_replace('\\', '/', $class) . '.php';
        //$file = APP . "/controllers/$class.php";
        //echo $file;
        if(is_file($file))
        {
            require_once $file;
        }
    });


    //Router::add('^page/?(?P<action>[a-z-]+)?$', ['controller' => 'Posts']);
    //default routes//
    Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
    Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

    //debug(Router::getRoutes());

    Router::dispatch($query);
