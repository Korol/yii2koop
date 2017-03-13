<?php
/**
 * Created by PhpStorm.
 * User: korol
 * Date: 29.09.16
 * Time: 19:35
 */

namespace app\controllers;

use app\models\News;
use yii\data\Pagination;

class NewsController extends FrontendController
{
    public function actionIndex()
    {
        $query = News::find()
            ->select('id, slug, title, keywords, description, cut, pubdate')
            ->where(['show' => 1])
            ->andWhere(['<=', 'pubdate', date('Y-m-d')]);
        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 10,
            'pageSizeParam' => false,
            'forcePageParam' => false]);
        $news = $query->orderBy(['pubdate' => SORT_DESC, 'id' => SORT_DESC])
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->asArray()
            ->all();
        $this->setMeta('Новости', 'Новости', 'Новости');
        return $this->render('index', compact('news', 'pages'));
    }

    public function actionView($id)
    {
        $news = News::find()
            ->where(['id' => $id, 'show' => 1])
            ->andWhere(['<=', 'pubdate', date('Y-m-d')])
            ->asArray()
            ->one();
        if(empty($news)) return $this->redirect(['index']);

        $this->setMeta($news['title'], $news['keywords'], $news['description']);
        return $this->render('view', compact('news'));
    }
}