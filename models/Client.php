<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $middle_name
 * @property string $phone
 * @property string $type
 * @property string $tin
 * @property string $checking_acc
 * @property string $mfo
 * @property string $org_name
 * @property string $passport_serial
 * @property int $passport_number
 * @property string $status
 * @property string $comments
 * @property int $created_at
 * @property int $updated_at
 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'phone', 'type', 'passport_serial', 'passport_number'], 'required'],
            [['type', 'comments'], 'string'],
            [['passport_number', 'created_at', 'updated_at'], 'integer'],
            [['first_name', 'last_name', 'middle_name', 'org_name'], 'string', 'max' => 100],
            [['phone', 'checking_acc'], 'string', 'max' => 20],
            [['tin', 'passport_serial'], 'string', 'max' => 10],
            [['mfo'], 'string', 'max' => 9],
            [['status'], 'string', 'max' => 50],
            [['status'], 'default', 'value' => 'normal'],
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
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'middle_name' => 'Отчество',
            'phone' => 'Телефон',
            'type' => 'Тип',
            'tin' => 'ИНН',
            'checking_acc' => 'Р/С',
            'mfo' => 'МФО',
            'org_name' => 'Наименование организации',
            'passport_serial' => 'Паспорт серия',
            'passport_number' => 'Паспорт номер',
            'status' => 'Статус',
            'comments' => 'Комментарий',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
