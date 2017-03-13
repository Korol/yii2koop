<?php

namespace app\modules\admin\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use app\components\Slug;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $keywords
 * @property string $description
 * @property string $cut
 * @property string $content
 * @property string $pubdate
 * @property string $created_at
 * @property string $updated_at
 * @property integer $show
 */
class News extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // если вместо метки времени UNIX используется datetime:
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'cut', 'content'], 'required'],
            [['description', 'content', 'cut'], 'string'],
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
            'title' => 'Заголовок',
            'slug' => 'URL',
            'keywords' => 'Keywords',
            'description' => 'Description',
            'cut' => 'Краткий текст',
            'content' => 'Контент новости',
            'pubdate' => 'Дата публикации',
            'created_at' => 'Создана',
            'updated_at' => 'Отредактирована',
            'show' => 'Статус',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->slug = (empty($this->slug)) ? Slug::url_slug($this->title): $this->slug;
            return true;
        }
        return false;
    }
}
