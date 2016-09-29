<?php
/**
 * Created by PhpStorm.
 * User: korol
 * Date: 29.09.16
 * Time: 19:35
 */

namespace app\controllers;


class NewsController extends FrontendController
{
    public function actionIndex($page = 0)
    {
        var_dump('News/Index page = ' . $page);
    }

    public function actionArticle($id, $slug = '')
    {
        var_dump('News/Article id = ' . $id . ', slug = ' . $slug);
    }
} 