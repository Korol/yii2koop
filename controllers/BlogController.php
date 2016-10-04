<?php
/**
 * Created by PhpStorm.
 * User: korol
 * Date: 29.09.16
 * Time: 19:35
 */

namespace app\controllers;


class BlogController extends FrontendController
{
    public function actionIndex($page = 0)
    {
        return $this->render('index', compact('page'));
    }

    public function actionArticle($id, $slug = '')
    {
        return $this->render('article', compact('id', 'slug'));
    }
} 