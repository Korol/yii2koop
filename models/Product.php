<?php
/**
 * Created by PhpStorm.
 * User: korol
 * Date: 20.09.16
 * Time: 19:29
 */

namespace app\models;
use yii\db\ActiveRecord;

class Product extends ActiveRecord{

    public static function tableName()
    {
        return 'product';
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
} 