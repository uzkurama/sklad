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
            [['name', 'count', 'price', 'unit_id'], 'required'],
            [['count', 'price', 'unit_id', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['created_at'], 'default', 'value' => date('U')],
            [['updated_at'], 'default', 'value' => null],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'count' => 'Кол-во',
            'price' => 'Цена',
            'unit_id' => 'Единица измерения',
            'unit.name' => 'Единица измерения',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
        ];
    }

    public function getUnit()
    {
        return $this->hasOne(Unit::className(), ['id' => 'unit_id']);
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
