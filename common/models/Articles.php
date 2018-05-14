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
        return 'Articles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'model', ], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'model'], 'string', 'max' => 255],
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
            'model' => Yii::t('app', 'Model'),
            'status' => Yii::t('app', 'Status'),
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
