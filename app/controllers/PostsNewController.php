<?php

namespace app\controllers;


class PostsNewController extends AppController
{
    public function actionIndex()
    {
        echo 'PostsNew::index';
    }

    public function actionTest()
    {
        echo 'PostsNew::test';
        $this->layout = 'main';
        $name = 'Hadzhi';
        $surname = 'Daudov';
        $country = [
            'Russia' => 'Russian Federation',
            'Britain' => 'Great Britain',
            'USA' => 'United States of America'
        ];
        $this->setVars(compact('name', 'surname', 'country'));
    }

    public function actionTestPage()
    {
        echo 'PostsNew::testPage';
    }

    public function before()
    {
        echo 'PostsNew::testPage';
    }
}