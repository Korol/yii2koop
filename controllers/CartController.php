<?php
/**
 * Created by PhpStorm.
 * User: korol
 * Date: 11.03.17
 * Time: 11:53
 */

namespace app\controllers;
use app\models\Product;
use app\models\Cart;
use Yii;

/*Array
(
    [1] => Array
    (
        [qty] => QTY
        [title] => TITLE
        [price] => PRICE
    )
    [10] => Array
    (
        [qty] => QTY
        [title] => TITLE
        [price] => PRICE
    )
)
    [qty] => QTY,
    [sum] => SUM
);*/

class CartController extends FrontendController
{
    public function actionAdd()
    {
        $id = Yii::$app->request->get('id');
        $qty = Yii::$app->request->get('qty');
        $product = Product::findOne($id);
        if(empty($product)) return false;
        $qty = ($qty > 0) ? (int)$qty : 1;
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->addToCart($product, $qty);
        $this->layout = false;
        return $this->render('cart_modal', compact('session'));
    }

    public function actionClear()
    {
        $session = Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.sum');
        $this->layout = false;
        return $this->render('cart_modal', compact('session'));
    }
} 