<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use unclead\multipleinput\MultipleInput;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Delevery */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="delevery-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'delevery')->textInput(['maxlength' => true])->hint('Введите краткое описание поставки')->label('Название поставки') ?>

    <?= $form->field($model, 'owner')->dropDownList($filter_user, ['prompt' =>'Выберите владельца'])->label('Менеджер поставки')  ?>

    <?= $form->field($model, 'delevery_date')->textInput()->widget(DateTimePicker::className(), [
        'name' => 'delevery_date',
        'value' => Yii::$app->formatter->asDate($model->delevery_date, 'dd.MM.yyyy'),
        'pluginOptions' => [
            'format' => 'D, dd-M-yyyy, hh:ii'
        ]
    ])->label('Запланированная дата поставки в магазин') ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true])->label('Дополнительное описание') ?>

    <?= $form->field($model, 'sit_id')->dropDownList($filter_sit, ['prompt' =>'Выберите сит поставки']) ->label('Магазин, в который придет поставка')?>

    <?= $form->field($model, 'products')->widget(MultipleInput::className(), [
        'max' => 10,
        'cloneButton' => true,
        'columns' => [
            [
                'name'  => 'id',
                //'type'  => 'dropDownList',
                'title' => 'Артикулы',
               // 'defaultValue' => 1,
//                'items' => [
//                    1 => 'id: 1, price: $19.99, title: product1',
//                    2 => 'id: 2, price: $29.99, title: product2',
//                    3 => 'id: 3, price: $39.99, title: product3',
//                    4 => 'id: 4, price: $49.99, title: product4',
//                    5 => 'id: 5, price: $59.99, title: product5',
//                ],
            ],
//            [
//                'name'  => 'time',
//                'type'  => DateTimePicker::className(),
//                'title' => 'due date',
//                'defaultValue' => date('d-m-Y h:i')
//            ],
            [
                'name'  => 'count',
                'title' => 'Count',
                'defaultValue' => 1,
                'enableError' => true,
                'options' => [
                    'type' => 'number',
                    'class' => 'input-priority',
                ]
            ]
        ]
    ])->label(false);
    ?>



    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
