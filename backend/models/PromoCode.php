<?php

namespace backend\models;

/**
 * This is the model class for table "promo_codes".
 *
 * @property integer $id
 * @property string $name
 * @property string $fee
 * @property string $start_date
 * @property string $end_date
 * @property integer $id_cities
 * @property string $status
 *
 * @property City $idCities
 */
class PromoCode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'promo_codes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $dateFormat = 'Y-m-d';
        return [
            [['name', 'start_date', 'end_date', 'id_cities', 'fee'], 'required'],
            [['status'], 'default', 'value' => 'inactive'],
            [['fee'], 'double', 'min' => 0.01],
            [['start_date', 'end_date'], 'date', 'format' => $dateFormat],
            [['id_cities'], 'integer'],
            [['status'], 'in', 'range' => ['active', 'inactive']],
            ['start_date', 'compare', 'compareValue' => date($dateFormat), 'operator' => '>=', 'type' => 'date'],
            ['end_date', 'compare', 'compareValue' => date($dateFormat), 'operator' => '>', 'type' => 'date'],
            ['end_date', 'compare', 'compareAttribute' => 'start_date', 'operator' => '>', 'type' => 'date'],
            ['name', 'match', 'pattern' => '/[a-zA-Z]/', 'message' => 'Invalid characters in Name'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['id_cities'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['id_cities' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'fee' => 'Fee',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'id_cities' => 'Tariff zone',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCities()
    {
        return $this->hasOne(City::className(), ['id' => 'id_cities']);
    }
}
