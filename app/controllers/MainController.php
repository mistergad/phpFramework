<?php

namespace app\controllers;

use app\models\Main;

class MainController extends AppController
{
    public function actionIndex()
    {

        /*$this->layout = false;
        $this->layout = 'main';
        $this->setVars(['name' => 'Hadzhi', 'surname' => 'Daudov']);*/

        $model = new Main();

        $posts = $model->findAll();
        $sqlQuery = cubrid_real_escape_string("Select * from {$model->table} WHERE id = 20");
        $sel = $model->query();
        var_dump($sel);
        $title = 'Blog of posts';
        $this->setVars(compact('posts', 'title'));
    }
}