<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%priceform}}".
 *
 * @property int $id
 * @property string $name
 * @property int $seller
 * @property int $owner
 * @property int $fond
 * @property int $programmer
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Sit[] $sits
 */
class Priceform extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%priceform}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'created_at', 'updated_at'], 'required'],
            [['seller', 'owner', 'fond', 'programmer', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'seller' => Yii::t('app', 'Seller'),
            'owner' => Yii::t('app', 'Owner'),
            'fond' => Yii::t('app', 'Fond'),
            'programmer' => Yii::t('app', 'Programmer'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSits()
    {
        return $this->hasMany(Sit::className(), ['priceform_id' => 'id']);
    }
}
