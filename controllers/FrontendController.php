<?php
/**
 * Created by PhpStorm.
 * User: korol
 * Date: 20.09.16
 * Time: 23:29
 */

namespace app\controllers;


class FrontendController extends AppController{

    public $title_part = 'Магазин | Народная Кооперация';

    protected function setMeta($title = null, $keywords = null, $description = null)
    {
        $this->view->title = (!empty($title)) ? $title . ' | ' . $this->title_part : $this->title_part;
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => "$keywords"]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => "$description"]);
    }

} 