<?php

namespace app\modules\admin\models;

use Yii;
use app\components\Slug;

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
    public $image;
    public $gallery;

    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }

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
            [['title', 'price', 'units'], 'required'],
            [['price', 'price_special'], 'number'],
            [['category_id', 'provider_id', 'producer_id', 'show', 'qty'], 'integer'],
            [['content', 'new', 'hit', 'sale', 'popular', 'recommended', 'write_off', 'special_conditions'], 'string'],
            [['added_date', 'provider_date'], 'safe'],
            [['added_date', 'provider_date'], 'default', 'value' => null],
            [['title', 'url', 'units', 'keywords', 'description', 'img', 'sku'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'png, jpg, gif, jpeg'],
            [['gallery'], 'file', 'extensions' => 'png, jpg, gif, jpeg', 'maxFiles' => 6],
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
            'image' => 'Главное фото товара',
            'gallery' => 'Другие фото товара',
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
            'img' => 'Фото',
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $imgPath = 'upload/store/' . $this->image->baseName . '.' . $this->image->extension;
            $this->image->saveAs($imgPath);
            $this->attachImage($imgPath, true);
            @unlink($imgPath);
            return true;
        } else {
            return false;
        }
    }

    public function uploadGallery()
    {
        if ($this->validate()) {
            foreach($this->gallery as $file){
                $imgPath = 'upload/store/' . $file->baseName . '.' . $file->extension;
                $file->saveAs($imgPath);
                $this->attachImage($imgPath);
                @unlink($imgPath);
            }
            return true;
        } else {
            return false;
        }
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->added_date = (empty($this->added_date)) ? date('Y-m-d H:i:s') : $this->added_date . ' ' . date('H:i:s');
            $this->provider_date = (empty($this->provider_date)) ? date('Y-m-d H:i:s') : $this->provider_date . ' ' . date('H:i:s');
            $this->url = (empty($this->url)) ? Slug::url_slug($this->title): $this->url;
            return true;
        }
        return false;
    }

    public function getMainImage($id)
    {
        $mdl = $this->findOne($id);
        $img = $mdl->getImage();
        return ($img) ? $img->getUrl('50x') : '';
    }
}
