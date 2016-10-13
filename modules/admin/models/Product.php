<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $title
 * @property string $url
 * @property string $price
 * @property string $price_special
 * @property string $units
 * @property integer $category_id
 * @property string $content
 * @property string $keywords
 * @property string $description
 * @property string $img
 * @property string $new
 * @property string $hit
 * @property string $sale
 * @property string $popular
 * @property string $recommended
 * @property integer $provider_id
 * @property integer $producer_id
 * @property string $sku
 * @property string $added_date
 * @property string $provider_date
 * @property string $write_off
 * @property string $special_conditions
 * @property integer $show
 * @property integer $qty
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price', 'price_special'], 'number'],
            [['category_id', 'provider_id', 'producer_id', 'show', 'qty'], 'integer'],
            [['content', 'new', 'hit', 'sale', 'popular', 'recommended', 'write_off', 'special_conditions'], 'string'],
            [['added_date', 'provider_date'], 'safe'],
            [['title', 'url', 'units', 'keywords', 'description', 'img', 'sku'], 'string', 'max' => 255],
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getCategoryTitle()
    {
        $category = $this->category;
        return $category ? $category->title : '-';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'url' => 'Url',
            'price' => 'Цена',
            'price_special' => 'Акционная цена',
            'units' => 'Единица',
            'category_id' => 'Категория',
            'content' => 'Описание',
            'keywords' => 'META-Keywords',
            'description' => 'META-Description',
            'img' => 'Картинка',
            'new' => 'Новинка',
            'hit' => 'Хит',
            'sale' => 'Распродажа',
            'popular' => 'Популярный',
            'recommended' => 'Рекомендованный',
            'provider_id' => 'Поставщик',
            'producer_id' => 'Производитель',
            'sku' => 'Артикул',
            'added_date' => 'Дата добавления',
            'provider_date' => 'Дата поставки',
            'write_off' => 'Списание',
            'special_conditions' => 'Условия Акции',
            'show' => 'Статус',
            'qty' => 'Кол-во',
        ];
    }
}
