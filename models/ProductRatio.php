<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_ratio".
 *
 * @property int $id
 * @property int $product_id
 * @property int $sub_product_id
 * @property int $ratio
 */
class ProductRatio extends \yii\db\ActiveRecord
{
    public $component_value = 0;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_ratio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'sub_product_id', 'ratio'], 'required'],
            [['product_id', 'sub_product_id', 'ratio'], 'integer'],
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
            'sub_product_id' => 'Sub Product ID',
            'ratio' => 'Ratio',
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    public function getSubproduct()
    {
        return $this->hasOne(SubProduct::className(), ['id' => 'sub_product_id']);
    }
}
