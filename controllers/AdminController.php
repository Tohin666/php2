<?php

namespace app\controllers;


class AdminController extends Controller
{
    public function actionIndex()
    {
        $model = [];

        echo $this->render("admin", ['model' => $model]);
    }

}