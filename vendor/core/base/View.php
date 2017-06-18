<?php
/**
 * Created by PhpStorm.
 * User: asus-pc
 * Date: 07.06.2017
 * Time: 19:24
 */

namespace vendor\core\base;


class View
{
    /*
     * Current route(path)
     * @var array
     */
    protected $route = [];

    /*
     * Current layout(template)
     * @var string
     */
    protected $layout;

    public function __construct($route, $layout = '')
    {
        $this->route = $route;
        if($layout === false)
        {
            $this->layout = false;
        }
        else
        {
            $this->layout = $layout ?: LAYOUT;
        }

    }

    public function render($vars)
    {
        if(is_array($vars)) extract($vars);

        $file_view = APP . "/views/{$this->route['controller']}/{$this->route['action']}.php";

        ob_start();
        if(is_file($file_view))
        {
            require $file_view;
        }
        else
        {
            echo "<p>Cannot find view <b>$file_view</b></p>";
        }
        $content = ob_get_clean();

        if($this->layout !== false)
        {
            $file_layout = APP . "/views/layouts/{$this->layout}.php";
            if(is_file($file_layout))
            {
                require $file_layout;
            }
            else
            {
                echo "<p>Cannot find view <b>$file_layout</b></p>";
            }
        }


    }
}