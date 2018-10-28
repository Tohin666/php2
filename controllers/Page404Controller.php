<?php


namespace app\controllers;


class Page404Controller extends Controller
{
    public function actionIndex(){

        echo $this->render("Page404");

    }

}