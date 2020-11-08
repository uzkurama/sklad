<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property string $type_id
 * @property int $count
 * @property int $price
 * @property int $unit_id
 * @property int $created_at
 * @property int|null $updated_at
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type_id', 'unit_id', 'created_at'], 'required'],
            [['count', 'price', 'unit_id', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['type_id'], 'string', 'max' => 20],
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
            'type_id' => 'Type ID',
            'count' => 'Count',
            'price' => 'Price',
            'unit_id' => 'Unit ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
