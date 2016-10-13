<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $title
 * @property string $url
 * @property integer $parent_id
 * @property string $path
 * @property string $keywords
 * @property string $description
 * @property integer $show
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    public function getParent()
    {
        return $this->hasOne(Category::className(), ['id' => 'parent_id']);
    }

    public function getParentTitle()
    {
        $parent = $this->parent;
        return $parent ? $parent->title : '-';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['id'], 'required'],
            [['parent_id', 'show'], 'integer'],
            [['keywords', 'description'], 'string'],
            [['title', 'url'], 'string', 'max' => 255],
        ];
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
            'parent_id' => 'Родительская категория',
            'path' => 'Путь',
            'keywords' => 'META-Keywords',
            'description' => 'META-Description',
            'show' => 'Статус',
        ];
    }

    public static function getParentsList()
    {
        // Выбираем только те категории, у которых есть дочерние категории
        $parents = Category::find()
            ->select(['c.id', 'c.title'])
            ->join('JOIN', 'category c', 'category.parent_id = c.id')
            ->distinct(true)
            ->all();

        return ArrayHelper::map($parents, 'id', 'title');
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if(empty($this->url)){
                $this->url = url_slug($this->title);
            }
            return true;
        } else {
            return false;
        }
    }

    // TODO
    // сделать afterSave() с формированием путей path для категории (build_category_path($category_id) из index.php в ST)
}
