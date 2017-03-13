<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $keywords
 * @property string $description
 * @property string $content
 * @property string $pubdate
 * @property string $created_at
 * @property string $updated_at
 * @property integer $show
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'content'], 'string'],
            [['pubdate', 'created_at', 'updated_at'], 'safe'],
            [['show'], 'integer'],
            [['title', 'slug', 'keywords'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'slug' => 'Slug',
            'keywords' => 'Keywords',
            'description' => 'Description',
            'content' => 'Content',
            'pubdate' => 'Pubdate',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'show' => 'Show',
        ];
    }
}
