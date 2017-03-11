<?php
/**
 * Created by PhpStorm.
 * User: korol
 * Date: 11.03.17
 * Time: 11:58
 */

namespace app\models;

use yii\db\ActiveRecord;

class Cart extends ActiveRecord
{

    public function addToCart($product, $qty = 1)
    {
        if(isset($_SESSION['cart'][$product->id])){
            $_SESSION['cart'][$product->id]['qty'] += $qty;
        }
        else{
            $_SESSION['cart'][$product->id] = [
                'qty' => $qty,
                'title' => $product->title,
                'price' => $product->price,
            ];
            $_SESSION['cart.qty'] = isset($_SESSION['cart.qty'])
                ? $_SESSION['cart.qty'] + 1
                : 1;
        }
        $_SESSION['cart.sum'] = isset($_SESSION['cart.sum'])
            ? $_SESSION['cart.sum'] + ($qty * $product->price)
            : ($qty * $product->price);
    }
} 