<?php

namespace backend\models;

/**
 * This is the model class for table "cities".
 *
 * @property integer $id
 * @property string $name
 *
 * @property PromoCode[] $promoCodes
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromoCodes()
    {
        return $this->hasMany(PromoCode::className(), ['id_cities' => 'id']);
    }
}
