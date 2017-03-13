<?php

namespace app\controllers;

use app\models\Page;
use yii\helpers\Url;

class PageController extends FrontendController
{
    public function actionIndex()
    {
        $this->redirect(Url::to(['/shop']));
        //return $this->render('index');
    }

    public function actionView($slug)
    {
        if(empty($slug)) return $this->redirect(Url::to(['/shop']));

        $page = Page::find()->where(['slug' => $slug, 'show' => 1])->one();
        $this->setMeta($page['title'], $page['keywords'], $page['description']);
        return $this->render('view', compact('page'));
    }

}
