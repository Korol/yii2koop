<?php
/**
 * Created by PhpStorm.
 * User: korol
 * Date: 20.09.16
 * Time: 23:27
 */

namespace app\controllers;


class ShopController extends FrontendController {

    public function actionCategory($id, $url = '', $page = 1)
    {
        var_dump($id, $url, $page);
    }
} 