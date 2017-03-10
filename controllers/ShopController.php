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
use yii\data\Pagination;


class ShopController extends FrontendController {

    public function actionIndex()
    {
        $popular_products = Product::find()->where(['popular' => '1'])->all();
        $sale_products = Product::find()->where(['sale' => '1'])->all();
        $new_products = $hit_products = $recommended_products = [];
        $carousel = [
            0 => ['image' => '1.jpg'],
            1 => ['image' => '2.jpg'],
            2 => ['image' => '3.jpg'],
            3 => ['image' => '4.jpg'],
            4 => ['image' => '5.jpg'],
        ]; // TODO: сделать управление баннерами через Админку

        if($this->themeName == 'basic'){
            $new_products = Product::find()->where(['new' => '1'])->all();
            $hit_products = Product::find()->where(['hit' => '1'])->all();
            $recommended_products = Product::find()->where(['recommended' => '1'])->all();
            $carousel = [];
        }
        $this->setMeta();
        return $this->render('index', compact('popular_products', 'new_products', 'hit_products', 'sale_products', 'recommended_products', 'carousel'));
    }

    public function actionCategory($id, $slug = '', $page = 1)
    {
        $category = Category::findOne(['id' => $id]);
        if(empty($category)){
            throw new \yii\web\HttpException(404, 'Такой категории нет!');
        }
        $this->setActiveCategory($id);
        $sub_categories = $this->getSubcategoriesIds($id);
        if(!empty($sub_categories)){
            $query = Product::find()->where(['in', 'category_id', $sub_categories]);
        }
        else{
            $query = Product::find()->where(['category_id' => $id]);
        }
        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 15,
            'pageSizeParam' => false,
            'forcePageParam' => false]);
        $products = $query->orderBy(['id' => SORT_DESC])->offset($pages->offset)->limit($pages->limit)->all();
        $this->setMeta($category->title, $category->keywords, $category->description);
        return $this->render('category', compact('category', 'products', 'pages'));
    }

    public function actionProduct($id, $slug = '')
    {
//        $product = Product::find()->with('category')->where(['id' => $id])->limit(1)->one(); // жадная загрузка
        $product = Product::findOne($id); // ленивая загрузка
        if(empty($product)){
            throw new \yii\web\HttpException(404, 'Такого продукта нет!');
        }
        $recommended_products = Product::find()->where(['recommended' => '1'])->limit(8)->all();
        $this->setMeta($product->title, $product->keywords, $product->description);
        return $this->render('product', compact('product', 'recommended_products'));
    }

    public function actionSearch($search, $page = 1)
    {
        $search = trim($search);
        $this->setMeta('Результаты поиска');
        if(empty($search)){
            return $this->render('search', compact('search'));
        }
        $query = Product::find()->where(['like', 'title', $search]);
        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 15,
            'pageSizeParam' => false,
            'forcePageParam' => false]);
        $products = $query->orderBy(['id' => SORT_DESC])->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('search', compact('products', 'pages', 'search'));
    }
} 