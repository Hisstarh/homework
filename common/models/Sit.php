<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%sit}}".
 *
 * @property int $id
 * @property string $sit
 * @property string $owner
 * @property string $adress
 * @property int $margin_on_sit
 * @property int $priceform_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Articles[] $articles
 * @property Delevery[] $deleveries
 * @property Priceform $priceform
 * @property User[] $users
 */
class Sit extends \yii\db\ActiveRecord
{
    const STATUS_CLOSE = 0;
    const STATUS_ACTIVE = 10;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sit}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_CLOSE]],
            [['sit', 'owner', 'adress', 'priceform_id', 'created_at', 'updated_at'], 'required'],
            [['margin_on_sit', 'priceform_id', 'created_at', 'updated_at'], 'integer'],
            [['sit', 'owner', 'adress'], 'string', 'max' => 255],
            [['priceform_id'], 'exist', 'skipOnError' => true, 'targetClass' => Priceform::className(), 'targetAttribute' => ['priceform_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'sit' => Yii::t('app', 'Sit'),
            'owner' => Yii::t('app', 'Owner'),
            'adress' => Yii::t('app', 'Adress'),
            'status' => Yii::t('app', 'Status'),
            'margin_on_sit' => Yii::t('app', 'Margin On Sit'),
            'priceform_id' => Yii::t('app', 'Priceform ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public static function findSit($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Articles::className(), ['sit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeleveries()
    {
        return $this->hasMany(Delevery::className(), ['sit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPriceform()
    {
        return $this->hasOne(Priceform::className(), ['id' => 'priceform_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['sit_id' => 'id']);
    }
}
