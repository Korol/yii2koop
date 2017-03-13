<?php

namespace app\modules\admin\models;

use Yii;
use yii\db\ActiveRecord;
//use yii\db\Expression;

/**
 * This is the model class for table "page".
 *
 * @property integer $id
 * @property string $slug
 * @property string $title
 * @property string $keywords
 * @property string $description
 * @property string $content
 * @property integer $show
 */
class Page extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'content'], 'string'],
            [['show'], 'integer'],
            [['slug', 'title', 'keywords'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slug' => 'URL',
            'title' => 'Название',
            'keywords' => 'Keywords',
            'description' => 'Description',
            'content' => 'Контент страницы',
            'show' => 'Показ',
        ];
    }
}
