<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "Articles".
 *
 * @property int $id
 * @property string $name
 * @property string $model
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class Articles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%articles}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'model',], 'required'],
            [['code'], 'integer', 'max' => 13],
            [['code'], 'unique'],
            [['code', 'side_left', 'side_right', 'side_front', 'side_rear', 'side_top', 'side_bottom', 'status', 'created_at', 'updated_at', 'update_user'], 'integer'],
            [['sell_price', 'purchase_price', 'margin'], 'double'],
            [['name', 'place', 'mark', 'body', 'drive', 'model', 'description', 'code_manufacturer', 'optics'], 'string', 'max' => 255],
            [['delevery_id'], 'exist', 'skipOnError' => true, 'targetClass' => Delevery::className(), 'targetAttribute' => ['delevery_id' => 'id']],
            [['sit_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sit::className(), 'targetAttribute' => ['sit_id' => 'id']],
            [['update_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['update_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getDelevery()
    {
        return $this->hasMany(Delevery::className(), ['id' => 'delevery_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasOne(Users::className(), ['id' => 'update_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSit()
    {
        return $this->hasOne(Sit::className(), ['id' => 'sit_id']);
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'Code'),
            'side_left' => Yii::t('app', 'Left'),
            'side_front' => Yii::t('app', 'Front'),
            'side_top' => Yii::t('app', 'Top'),
            'side_right' => Yii::t('app', 'Right'),
            'side_rear' => Yii::t('app', 'Rear'),
            'side_botton' => Yii::t('app', 'Botton'),
            'sell_price' => Yii::t('app', 'Sell price'),
            'purchase_price' => Yii::t('app', 'Purchase price'),
            'place' => Yii::t('app', 'Place'),
            'mark' => Yii::t('app', 'Mark'),
            'body' => Yii::t('app', 'Body'),
            'description' => Yii::t('app', 'Description'),
            'code_manufacturer' => Yii::t('app', 'Code manufacturer'),
            'optics' => Yii::t('app', 'Optics'),
            'name' => Yii::t('app', 'Name'),
            'model' => Yii::t('app', 'Model'),
            'status' => Yii::t('app', 'Status'),
            'delevery_id' => Yii::t('app', 'Delevery ID'),
            'sit_id' => Yii::t('app', 'Sit ID'),
            'update_user' => Yii::t('app', 'Update User'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return ArticlesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ArticlesQuery(get_called_class());
    }

    public function behaviors()
    {
        return [
            'TimestampBehavior' => [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'value' => function () { return date('Y-m-d H:i:s'); },
            ],
            [
                // объявляем класс
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    // перед вставкой записи мы записываем в поля текщее время и дату
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    // при обнавлении записи мы записываем в поля текщее время и дату
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],


        ];
    }
}
