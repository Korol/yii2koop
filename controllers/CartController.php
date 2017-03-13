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
use app\models\Order;
use app\models\OrderItem;
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
        $qty = (int)Yii::$app->request->get('qty');
        $product = Product::findOne($id);
        if(empty($product)) return false;
        $qty = ($qty > 0) ? $qty : 1;
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->addToCart($product, $qty);
        if(!Yii::$app->request->isAjax){
            return $this->redirect(Yii::$app->request->referrer);
        }
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

    public function actionDelItem()
    {
        $id = Yii::$app->request->get('id');
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->recalc($id);
        $this->layout = false;
        return $this->render('cart_modal', compact('session'));
    }

    public function actionShow()
    {
        $session = Yii::$app->session;
        $session->open();
        $this->layout = false;
        return $this->render('cart_modal', compact('session'));
    }

    public function actionQty()
    {
        $session = Yii::$app->session;
        $session->open();
        echo (!empty($session['cart.qty'])) ? $session['cart.qty'] : 0;
    }

    public function actionView()
    {
        $session = Yii::$app->session;
        $session->open();
        $this->setMeta('Корзина');
        $order = new Order();
        if($order->load(Yii::$app->request->post()) && !empty($session['cart'])){
            $order->qty = $session['cart.qty'];
            $order->sum = $session['cart.sum'];
            if($order->save()){
                $this->saveOrderItems($session['cart'], $order->id);
                // send client email
                Yii::$app->mailer->compose('order', ['session' => $session, 'order_id' => $order->id])
                    ->setFrom([Yii::$app->params['orderSendEmail'] => 'Интернет-магазин «Вкус Жизни»'])
                    ->setTo($order->email)
                    ->setSubject('Ваш заказ №' . $order->id)
                    ->send();
                // send admin email
                Yii::$app->mailer->compose('order_admin', ['session' => $session, 'order' => $order])
                    ->setFrom([Yii::$app->params['orderSendEmail'] => 'Интернет-магазин «Вкус Жизни»'])
                    ->setTo(Yii::$app->params['adminEmail'])
                    ->setSubject('Новый заказ №' . $order->id)
                    ->send();
                // remove cart
                $session->remove('cart');
                $session->remove('cart.qty');
                $session->remove('cart.sum');
                return $this->redirect(['thanks', 'order_id' => $order->id]);
            }
            else{
                $session->setFlash('error', 'Error!');
            }
        }
        return $this->render('view', compact('session', 'order'));
    }

    public function actionThanks($order_id)
    {
        return $this->render('thanks', compact('order_id'));
    }

    protected  function saveOrderItems($items, $order_id)
    {
        if(!empty($items) && !empty($order_id)){
            foreach($items as $id => $item){
                $order_item = new OrderItem();
                $order_item->order_id = $order_id;
                $order_item->product_id = $id;
                $order_item->title = $item['title'];
                $order_item->price = $item['price'];
                $order_item->qty = $item['qty'];
                $order_item->sum = $item['qty'] * $item['price'];
                $order_item->save();
            }
        }
    }

    public function actionChangeQty()
    {
        $id = (int)Yii::$app->request->get('id');
        $oper = Yii::$app->request->get('oper');
        if(!empty($id) && in_array($oper, ['plus', 'minus'])){
            $session = Yii::$app->session;
            $session->open();
            $cart = new Cart();
            $res = $cart->changeQty($id, $oper);
            if(!empty($res)){
                $res['id'] = $id;
                echo json_encode($res);
            }
            else{
                echo '';
            }
        }
        else{
            echo '';
        }
    }

    public function actionDelProduct()
    {
        $id = Yii::$app->request->get('id');
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->recalc($id);
        echo $session['cart.sum'];
    }
} 