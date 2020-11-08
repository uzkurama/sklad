<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sub_product".
 *
 * @property int $id
 * @property string $name
 * @property int $count
 * @property int $price
 * @property int $product_id
 * @property int $unit_id
 * @property int $created_at
 * @property int $updated_at
 */
class SubProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sub_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name', 'count', 'price', 'product_id', 'unit_id', 'created_at', 'updated_at'], 'required'],
            [['id', 'count', 'price', 'product_id', 'unit_id', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'count' => 'Count',
            'price' => 'Price',
            'product_id' => 'Product ID',
            'unit_id' => 'Unit ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
