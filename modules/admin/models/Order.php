<?php

namespace app\modules\admin\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $qty
 * @property string $sum
 * @property string $status
 * @property integer $user_id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property string $comment
 */
class Order extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
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

    public function getOrderItem(){
        return $this->hasMany(OrderItem::className(), ['order_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'phone', 'address'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['qty', 'user_id'], 'integer'],
            [['sum'], 'number'],
            [['status', 'comment'], 'string'],
            [['name', 'email', 'phone', 'address'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '№ заказа',
            'created_at' => 'Создан',
            'updated_at' => 'Отредактирован',
            'qty' => 'Кол-во товаров',
            'sum' => 'Сумма',
            'status' => 'Статус',
            'user_id' => 'Пользователь',
            'name' => 'Имя',
            'email' => 'Email',
            'phone' => 'Телефон',
            'address' => 'Адрес',
            'comment' => 'Комментарий к заказу',
        ];
    }

    public static function getStatusList()
    {
        return [
            '0' => 'Новый',
            '1' => 'Обработан',
            '2' => 'Оплачен',
            '3' => 'Выполнен',
        ];
    }

    public static function getStatusListHtml()
    {
        return [
            '0' => '<span class="label label-danger">Новый</span>',
            '1' => '<span class="label label-warning">Обработан</span>',
            '2' => '<span class="label label-info">Оплачен</span>',
            '3' => '<span class="label label-success">Выполнен</span>',
        ];
    }
}
