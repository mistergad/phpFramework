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
     * Current View
     * @var string
     */
    protected $view;

    /*
     * Current layout(template)
     * @var string
     */
    protected $layout;

    public function __construct($route, $layout = '', $view = '')
    {
        $this->route = $route;
        $this->layout = $layout ?: LAYOUT;
        $this->view = $view;
    }

    public function render()
    {
        $file_view = APP . "/views/{$this->route['controller']}/{$this->view}.php";
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