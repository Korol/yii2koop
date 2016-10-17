<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "provider".
 *
 * @property integer $id
 * @property string $title
 * @property string $url
 * @property string $description
 * @property string $address
 * @property string $phones
 * @property string $website
 * @property string $fax
 * @property string $logo
 */
class Provider extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provider';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['title', 'url', 'address', 'phones', 'website', 'fax', 'logo'], 'string', 'max' => 255],
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
            'description' => 'Описание',
            'address' => 'Адрес',
            'phones' => 'Телефоны',
            'website' => 'Web-сайт',
            'fax' => 'Fax',
            'logo' => 'Логотип',
        ];
    }
}
