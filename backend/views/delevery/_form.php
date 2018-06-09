<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use unclead\multipleinput\MultipleInput;
use unclead\multipleinput\MultipleInputColumn;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Delevery */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="delevery-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'delevery')->textInput(['maxlength' => true])->hint('Введите краткое описание поставки')->label('Название поставки') ?>

    <?= $form->field($model, 'owner')->dropDownList($filter_user, ['prompt' =>'Выберите владельца'])->label('Менеджер поставки')  ?>

    <?= $form->field($model, 'delevery_date')->widget(DateTimePicker::className(), [
        'name' => 'delevery_date',
        'options' => ['placeholder' => 'Установите Дату поставки'],
        'value' => Yii::$app->formatter->asDate($model->delevery_date, 'dd.MM.yyyy'),
        'pluginOptions' => [
            'format' => 'D, dd-M-yyyy, hh:ii',
            'autoclose' => true
        ]
    ])->label('Запланированная дата поставки в магазин') ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true])->label('Дополнительное описание') ?>

    <?= $form->field($model, 'sit_id')->dropDownList($filter_sit, ['prompt' =>'Выберите сит поставки']) ->label('Магазин, в который придет поставка')?>

    <?= $form->field($model, 'products')->widget(MultipleInput::className(), [
        'max' => 10,
        'cloneButton' => true,
        'columns' => [
            [
                'name'  => 'code',
                'title' => 'КОД',
                'options' => [
                    'type' => 'number',
                    'class' => 'input-priority',
                ]

            ],
            [
                'name'  => 'name',
                //'type'  => 'dropDownList',
                'title' => 'Артикулы',
                'options' => [
                    'type' => 'string',
                    'class' => 'input-priority',
                ]
            ],
            [
                'name'  => 'side_left',
                'type'  => MultipleInputColumn::TYPE_CHECKBOX_LIST,
                'title' => 'Сторона',
                'headerOptions' => [
                    'style' => 'width: 120px;'
                ],
                'options' => [
                    'style' => 'width: 120px; background-color: #fff; border: 1px solid #ccc; padding: 6px 12px;'
                ],
                'items' => [
                    0 => 'Левая ',
                    1 => 'Правая ',
                    2 => 'Передняя ',
                    3 => 'Задняя ',
                    4 => 'Верхняя ',
                    5 => 'Нижняя '

                ],

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
