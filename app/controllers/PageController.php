<?php
/**
 * Created by PhpStorm.
 * User: asus-pc
 * Date: 07.06.2017
 * Time: 18:42
 */

namespace app\controllers;



class PageController extends AppController
{
    public function actionView()
    {
        debug($this->route);
        debug($_GET);
    }
}