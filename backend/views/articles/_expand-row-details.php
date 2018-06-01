<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
//dump($model);
/* @var $this yii\web\View */
/* @var $model common\models\ArticlesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="articles-form">


    <?php $form = ActiveForm::begin([
        // идентификатор формы
        'id' => 'row-details-form',
      //  'layout'=>'horizontal',
        'enableAjaxValidation' => false,
        'enableClientValidation' => false,
        'options' => [
            // работает через pjax, т.е. обновляется без обновления страницы
            'data' => ['pjax' => true],
            // класс формы
            'class' => 'signup-form form-horizontal col-lg-11',
            // возможность загрузки файлов
            'enctype' => 'multipart/form-data'
        ],
        'fieldConfig' => [
            'template' => '<div class="col-md-3">{label}</div><div class="col-md-3">{input}</div>',
//            'horizontalCssClasses' => [
//                'label' => 'col-sm-4',
//                'offset' => 'col-sm-offset-4',
//                'wrapper' => 'col-sm-8',
//                'error' => '',
//                'hint' => '',
//            ],
        ],
    ]); ?>
    <div class="col-sm-6">
        <?= $form->field($model, 'place')->textInput(['readOnly'=> true])->label('Хранение');?>

        <?= $form->field($model, 'mark')->textInput(['readOnly'=> true])->label('Марка');?>

        <?= $form->field($model, 'body')->textInput(['readOnly'=> true])->label('Кузов');?>

        <?= $form->field($model, 'drive')->textInput(['readOnly'=> true])->label('Двигатель');?>

        <?= $form->field($model, 'model')->textInput(['readOnly'=> true])->label('Модель');?>

        <?= $form->field($model, 'code_manufacturer')->textInput(['readOnly'=> true])->label('Код мануфактуры');?>

        <?= $form->field($model, 'optics')->textInput(['readOnly'=> true])->label('Оптика');?>
    </div>
    <div class="col-sm-6">

        <?= $form->field($model, 'side_left')->textInput(['value' => (($model->side_left>0)?'Левая':(($model->side_right>0)?'Правая':'Не указано')),'readOnly'=> true])->label('Сторона');?>

        <?= $form->field($model, 'side_front')->textInput(['value' => (($model->side_front>0)?'Передняя':(($model->side_rear>0)?'Задняя':'Не указано')),'readOnly'=> true])->label('Расположение');?>

        <?= $form->field($model, 'side_left')->textInput(['value' => (($model->side_top>0)?'Верхняя':(($model->side_bottom>0)?'Нижняя':'Не указано')),'readOnly'=> true])->label('Положение');?>

        <?= $form->field($model, 'created_at')->textInput(['readOnly'=> true,
            'value'=>Yii::$app->formatter->asDatetime($model->created_at,"php:d.m.Y H:m"),
        ])
            ->label('Дата поставки');?>

        <?= $form->field($model, 'purchase_price')->textInput(['value' => Yii::$app->formatter->asDecimal($model->purchase_price),'readOnly'=> true])->label('Закупочная цена');?>

        <?= $form->field($model, 'sell_price')->textInput(['value' => Yii::$app->formatter->asDecimal($model->sell_price),'readOnly'=> true])->label('Продажная цена');?>

        <?= $form->field($model, 'margin')->textInput(['value' => Yii::$app->formatter->asDecimal($model->margin),'readOnly'=> true])->label('Маржа');?>

    </div>



    <div class="form-group">

    </div>

    <?php ActiveForm::end(); ?>

</div>



