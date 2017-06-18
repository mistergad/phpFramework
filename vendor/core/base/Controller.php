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
     * @array[]
     *      @var string controller
     *      @var string action
     *
     */
    protected $route = [];

    /*
     * Current layout(template)
     * @var string
     */
    protected $layout;

    /*
     * Transmitted variables
     * @var array
     */
    protected $vars = [];

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
        $vObj = new View($this->route, $this->layout);
        $vObj->render($this->vars);
    }

    public function setVars($vars)
    {
        $this->vars = $vars;
    }
}
