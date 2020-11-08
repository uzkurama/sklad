<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sale".
 *
 * @property int $id
 * @property int $product_id
 * @property int $price
 * @property int $count
 * @property int $payment
 * @property int $user_id
 * @property string|null $comments
 * @property int $client_id
 * @property int $delivery_price
 * @property string $status
 * @property int $created_at
 * @property int|null $updated_at
 */
class Sale extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sale';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'price', 'count', 'user_id', 'client_id', 'status', 'created_at'], 'required'],
            [['product_id', 'price', 'count', 'payment', 'user_id', 'client_id', 'delivery_price', 'created_at', 'updated_at'], 'integer'],
            [['comments'], 'string'],
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
            'product_id' => 'Product ID',
            'price' => 'Price',
            'count' => 'Count',
            'payment' => 'Payment',
            'user_id' => 'User ID',
            'comments' => 'Comments',
            'client_id' => 'Client ID',
            'delivery_price' => 'Delivery Price',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
