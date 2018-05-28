<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%delevery}}".
 *
 * @property int $id
 * @property string $delevery
 * @property string $owner
 * @property int $delevery_date
 * @property string $description
 * @property int $sit_id
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Articles[] $articles
 * @property Sit $sit
 */
class Delevery extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%delevery}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['delevery', 'owner', 'delevery_date', 'created_at', 'updated_at'], 'required'],
            [['delevery_date', 'sit_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['delevery', 'description'], 'string', 'max' => 255],
            [['owner'], 'string', 'max' => 32],
            [['delevery'], 'unique'],
            [['sit_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sit::className(), 'targetAttribute' => ['sit_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'delevery' => Yii::t('app', 'Delevery'),
            'owner' => Yii::t('app', 'Owner'),
            'delevery_date' => Yii::t('app', 'Delevery Date'),
            'description' => Yii::t('app', 'Description'),
            'sit_id' => Yii::t('app', 'Sit ID'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Articles::className(), ['delevery_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSit()
    {
        return $this->hasOne(Sit::className(), ['id' => 'sit_id']);
    }
    public function getUsers()
    {
        return $this->hasOne(Users::className(), ['id' => 'owner']);
    }
}
