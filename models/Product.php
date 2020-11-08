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
    public $ratio;
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
            [['name', 'type_id', 'unit_id'], 'required'],
            [['count', 'price', 'unit_id', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['type_id'], 'string', 'max' => 20],
            [['created_at'], 'default', 'value' => date('U')],
            [['updated_at'], 'default', 'value' => null],
            [['ratio'], 'safe'],
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
            'type_id' => 'Тип продукта',
            'type.name' => 'Тип продукта',
            'count' => 'Кол-во',
            'ratio' => 'Комплект',
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

    public function getType()
    {
        return $this->hasOne(Type::className(), ['id' => 'type_id']);
    }
}
