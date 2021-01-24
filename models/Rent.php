<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rent".
 *
 * @property int $id
 * @property int $product_id
 * @property int $price
 * @property int $count
 * @property int $payment
 * @property int $user_id
 * @property string|null $comments
 * @property int $client_id
 * @property int $expiry_date
 * @property int $delivery_price
 * @property string $status
 * @property int $created_at
 * @property int|null $updated_at
 */
class Rent extends \yii\db\ActiveRecord
{

    public $p_id;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rent';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price', 'count', 'user_id', 'client_id', 'expiry_date', 'status', 'created_at'], 'required'],
            [['price', 'count', 'payment', 'user_id', 'client_id', 'delivery_price', 'created_at', 'updated_at'], 'integer'],
            [['comments'], 'string'],
            [['product_id', 'expiry_date'], 'safe'],
            [['status'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Продукции',
            'price' => 'Цена',
            'count' => 'Кол-во',
            'payment' => 'Оплата',
            'user_id' => 'User ID',
            'comments' => 'Комментарий',
            'client_id' => 'Клиент',
            'expiry_date' => 'Срок до',
            'delivery_price' => 'Цена доставки',
            'status' => 'Статус',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
        ];
    }

    public function getClient()
    {
        return $this->hasOne(Client::className(), ['id' => 'client_id']);
    }

    public function getProduct()
    {
        $this->p_id = $this->product_id['product_id'];
        return $this->hasOne(Product::className(), ['id' => 'p_id']);
    }
}
