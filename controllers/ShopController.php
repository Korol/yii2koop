<?php
/**
 * Created by PhpStorm.
 * User: korol
 * Date: 20.09.16
 * Time: 23:27
 */

namespace app\controllers;
use app\models\Category;
use app\models\Product;
use Yii;


class ShopController extends FrontendController {

    public function actionIndex()
    {
        $popular_products = Product::find()->where(['popular' => '1'])->limit(6)->all();
        $new_products = Product::find()->where(['new' => '1'])->limit(4)->all();
        $hit_products = Product::find()->where(['hit' => '1'])->limit(4)->all();
        $sale_products = Product::find()->where(['sale' => '1'])->limit(4)->all();
        $recommended_products = Product::find()->where(['recommended' => '1'])->limit(8)->all();
        return $this->render('index', compact('popular_products', 'new_products', 'hit_products', 'sale_products', 'recommended_products'));
    }

    public function actionCategory($id, $slug = '', $page = 1)
    {
        var_dump($id, $slug, $page);
    }
} 