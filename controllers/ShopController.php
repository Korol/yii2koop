<?php
/**
 * Created by PhpStorm.
 * User: korol
 * Date: 20.09.16
 * Time: 23:27
 */

namespace app\controllers;


class ShopController extends FrontendController {

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCategory($id, $slug = '', $page = 1)
    {
        var_dump($id, $slug, $page);
    }
} 