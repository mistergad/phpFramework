<?php
/**
 * Created by PhpStorm.
 * User: asus-pc
 * Date: 07.06.2017
 * Time: 3:46
 */

namespace vendor\core\base;

/*
 * Description
 */

abstract class Controller
{
    /*
     * Current route(path)
     */
    protected $route = [];

    /*
     * Current layout(template)
     * @var string
     */
    protected $layout;


    public function __construct($route)
    {
        $this->route = $route;

        /*
        $file = APP . "/views/{$this->route['controller']}/{$this->route['action']}.php";
        if(file_exists($file))
        {
            include $file;
        }
        */
    }

    public function getView()
    {
        $vObj = new View($this->route, $this->layout, $this->route['action']);
        $vObj->render();
    }


}
