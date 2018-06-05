<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use backend\assets\AppAsset;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ArticlesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Articles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articles-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Articles'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions'=>function ($model, $key, $index, $grid){
            $class=$index%2?'odd':'even';
            return [
                'key'=>$key,
                'index'=>$index,
                'class'=>$class
            ];
        },
        //  'layout'=>"{sorter}\n{pager}\n{summary}\n{items}",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            [
//                'attribute'=>'Foto',
//                'label'=>'Фото',
//                'format'=>'raw',
//                'contentOptions' =>['class' => 'table_class','style'=>'display:block;'],
//                'content'=>function($data){
//                    return Html::img(Url::toRoute($data->category_image),[
//                        'alt'=>'yii2 - картинка в gridview',
//                        'style' => 'width:15px;'
//                    ]);
//                }
//            ],
            // 'id',
            [
                'class' => 'kartik\grid\CheckboxColumn',
                'headerOptions' => ['class' => 'kartik-sheet-style']
            ],
            [
               // 'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'name',
                'label'=>'Название',
                //'pageSummary' => 'Page Total',
                //'vAlign'=>'middle',
                'headerOptions'=>['class'=>'kv-sticky-column'],
                'contentOptions'=>['class'=>'kv-sticky-column'],
                //'editableOptions'=>['header'=>'Name', 'size'=>'md']

            ],
            'code:text:КОД',
            [
                'attribute'=>'status',
                'label'=>'Статус',
                'format'=>'raw',
                'filter' => [
                    0 => 'Удален',
                    10 => 'Активен',
                ],
                'value' => function ($model, $key, $index, $column) {
                    $active = $model->{$column->attribute} === 10;
                    return \yii\helpers\Html::tag(
                        'span',
                        $active ? 'Активен' : 'Удален',
                        [
                            'class' => 'label label-' . ($active ? 'success' : 'danger'),
                        ]
                    );
                },
            ],
            [
               // 'class' => 'yii\grid\SerialColumn',
                'attribute' => 'sit_id',
                'label'=>'Магазин',

               // 'vAlign'=>'middle',
              //  'headerOptions'=>['class'=>'kv-sticky-column'],
              // 'contentOptions'=>['class'=>'kv-sticky-column'],
                'format'=>'raw',
                'filter' => $filter_sit,
                'value' => function($model, $key, $index, $column){
                    $filters=[];
                    $filters=\common\models\Sit::find()->select(['sit'])->where(['id'=>$model->sit_id])->one();
                    return $filters->sit;
                },
               // 'editableOptions'=>['header'=>'sit', 'size'=>'md']

            ],

            'place:text:Полка',

            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'width' => '50px',
                'value' => function ($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
                'detail' => function ($model, $key, $index, $column) {
                    return Yii::$app->controller->renderPartial('_expand-row-details', ['model' => $model]);
                },
                'headerOptions' => ['class' => 'kartik-sheet-style'] ,
                'expandOneOnly' => true
            ],

            'mark:text:Марка',
            'body:text:Кузов',
            'drive:text:Двигатель',
            'model:text:Модель',
            'description:text:Описание',
            [
                'class' => 'rikcage\combinedcolumn\CombinedDataColumn',//'common\components\grid\CombinedDataColumn',
                'labelTemplate' => '{0}{1}{2}{3}{4}{5}',
                'valueTemplate' => '{0}{1}{2}{3}{4}{5}',
                'labels' => [
                    'Расположение запчасти',
                    ' ',
                    ' ',
                    ' ',
                    ' ',
                    ' ',
                ],
                'attributes' => [
                    'side_left:text',
                    'side_right:text',
                    'side_front:text',
                    'side_rear:text',
                    'side_top:text',
                    'side_bottom:text'
                ],
                'values' => [
                    function ($model, $_key, $_index, $_column) {
                        return ($model->side_left)?'Левая; ':'';
                    },
                    function ($model, $_key, $_index, $_column) {
                        return ($model->side_right)?'Правая; ':'';
                    },
                    function ($model, $_key, $_index, $_column) {
                        return ($model->side_front)?'Передняя; ':'';
                    },
                    function ($model, $_key, $_index, $_column) {
                        return ($model->side_rear)?'Задняя; ':'';
                    },
                    function ($model, $_key, $_index, $_column) {
                        return ($model->side_top)?'Верхняя; ':'';
                    },
                    function ($model, $_key, $_index, $_column) {
                        return ($model->side_bottom)?'Нижняя; ':'';
                    },
                ],
                'filterTemplate' => '<div class="row">
                                    <div class="col-md-10">{0}</div>
                                    </div>',


                    'filters'=> [ array('1' => 'Левая', '2' => 'Правая', '3' => 'Передняя', '4' => 'Задняя', '5' => 'Верхняя', '6' => 'Нижняя'),
                        [
                   0 => 'Левая; ',
                    1 => 'Правая; ',
                    2 => 'Передняя; ',
                    3 => 'Задняя; ',
                    4 => 'Верхняя; ',
                    5 => 'Нижняя; ',
                ],
                        [
                            0 => 'Левая; ',
                            1 => 'Правая; ',
                            2 => 'Передняя; ',
                            3 => 'Задняя; ',
                            4 => 'Верхняя; ',
                            5 => 'Нижняя; ',
                        ],
                    //select for currency null,
                    //input for rate
                    ],
//                'filter' =>[
//                    0 => 'Левая; ',
//                    1 => 'Правая; ',
//                    2 => 'Передняя; ',
//                    3 => 'Задняя; ',
//                    4 => 'Верхняя; ',
//                    5 => 'Нижняя; ',
//                ],

                'sortLinksOptions' => [
                    ['class' => 'text-nowrap'],
                    null,
                ],
            ],

            'code_manufacturer:text:Код манифактуры',
            'optics:text:Оптика',
            [
               // 'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'delevery_id',
                'label'=>'Поставка',
                'vAlign'=>'middle',
                'headerOptions'=>['class'=>'kv-sticky-column'],
                'contentOptions'=>['class'=>'kv-sticky-column'],
                'format'=>'raw',
                'filter' => $filter_delevery,
                'value' => function($model, $key, $index, $column){
                    $filters=[];
                    $filters=\common\models\Delevery::find()->select(['delevery'])->where(['id'=>$model->delevery])->one();
                    return $filters->sit;
                },

               // 'editableOptions'=>['header'=>'delevery_id', 'size'=>'md']

            ],
//            [
//                'class' => 'kartik\grid\FormulaColumn',
//                'attribute' => 'sell_price',
//                'label'=>'Закупочная',
//                'vAlign' => 'middle',
//                'hAlign' => 'right',
//                'width' => '7%',
//                'format' => ['decimal', 2],
//                'pageSummary' => true
//            ],
            [
                'class' => 'kartik\grid\FormulaColumn',
                'attribute' => 'purchase_price',
                'label'=>'Продажная Цена',
                'vAlign' => 'middle',
                'hAlign' => 'right',
                'width' => '7%',
                'format' => ['decimal', 2],
                'pageSummary' => true
            ],
//            [
//                'class' => 'kartik\grid\FormulaColumn',
//                'attribute' => 'margin',
//                'label'=>'Маржа',
//                'vAlign' => 'middle',
//                'hAlign' => 'right',
//                'width' => '7%',
//                'format' => ['decimal', 2],
//                'pageSummary' => true
//            ],
            [
                'class' => 'common\components\grid\CombinedDataColumn',
                'labelTemplate' => '{0} / {1}',
                'valueTemplate' => '{0} / {1}',
                'labels' => [
                    'Дата поставки',
                    'Последнее событие',
                ],
                'attributes' => [
                    'created_at:html',
                    'updated_at:html',
                ],
                'values' => [
                    function ($model, $_key, $_index, $_column) {
                        return  Yii::$app->formatter->asDatetime($model->created_at,"php:d.m.Y H:m" ) ;
                    },
                    function ($model, $_key, $_index, $_column) {
                        return  Yii::$app->formatter->asDatetime($model->updated_at,"php:d.m.Y H:m" ) ;
                    },
                ],
                'options' => ['width' => '150'],
                'sortLinksOptions' => [
                    ['class' => 'text-nowrap'],
                    null,
                ],
            ],
//            [
//                'attribute' => 'created_at',
//                'label'=>'Дата создания',
//                'format' =>  ['date', 'dd.MM.Y HH:mm:ss'],
//                'options' => ['width' => '140']
//            ],
//            [
//                'attribute' => 'updated_at',
//                'label'=>'Дата изменения',
//                'format' =>  ['date', 'dd.MM.Y HH:mm:ss'],
//                'options' => ['width' => '140']
//            ],
            [
                //'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'users.username',
                'label'=>'Сделано',
                'vAlign'=>'middle',
                'headerOptions'=>['class'=>'kv-sticky-column'],
                'contentOptions'=>['class'=>'kv-sticky-column'],
                //'editableOptions'=>['header'=>'owner', 'size'=>'md']



            ],
            ['class' => 'yii\grid\ActionColumn',
                'template' => ' {sell} {update}',
                'header'=>'Действия',
                'buttons' => [
                    'update' => function ($url,$model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-screenshot"> Редктировать</span>',
                            $url);
                    },
                    'sell' => function ($url,$model,$key) {
                        return Html::a('<span class="glyphicon glyphicon-minus"> Продать</span>', $url);
                    },
                ],
            ],
//            [
//                'class' => 'kartik\grid\ActionColumn',
//                'dropdown' => true,
//                'vAlign'=>'middle',
//                'header'=>'Действия',
//                'urlCreator' => function($action, $model, $key, $index) {
//                                    return '#';
//                                },
//                'viewOptions'=>['title'=>$viewMsg, 'data-toggle'=>'tooltip'],
//                'updateOptions'=>['title'=>$updateMsg, 'data-toggle'=>'tooltip'],
//              //  'deleteOptions'=>['title'=>$deleteMsg, 'data-toggle'=>'tooltip'],
//                'headerOptions' => ['class' => 'kartik-sheet-style'],
//            ],

        ],
        'containerOptions' => ['style'=>'overflow: auto'], // only set when $responsive = false
        'beforeHeader'=>[
            [
                'columns'=>[
                    ['content'=>'Товар', 'options'=>['colspan'=>7, 'class'=>'text-center warning']],
                    ['content'=>'Дополнительная информация', 'options'=>['colspan'=>9, 'class'=>'text-center warning']],
                    ['content'=>'Тарифы', 'options'=>['colspan'=>2, 'class'=>'text-center warning']],
                    ['content'=>'Техническая информация', 'options'=>['colspan'=>2, 'class'=>'text-center warning']],
                    [
                        'content'=>'Управление',
                        'options'=>['colspan'=>2, 'class'=>'text-center warning']
                    ],
                ],
                'options'=>['class'=>'skip-export'] // remove this row from export
            ]
        ],
        'toolbar' =>  [
            ['content'=>
                Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>Yii::t('kvgrid', 'Add Book'), 'class'=>'btn btn-success', 'onclick'=>'alert("будет ссылка на создание поставки");']) . ' '.
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], ['data-pjax'=>0, 'class' => 'btn btn-default', 'title'=>Yii::t('kvgrid', 'Reset Grid')])
            ],
            '{export}',
            '{toggleData}'
        ],
       // 'toggleDataOptions' => ['minCount' => 10],
        'pjax' => true,
        'bordered' => true,
        'striped' => false,
        'condensed' => false,
        'responsive' => true,
        'hover' => true,
       // 'floatHeader' => true,
        'floatHeaderOptions' => ['scrollingTop' => $scrollingTop],
        'showPageSummary' => false,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY
        ],

    ]); ?>
    <?php Pjax::end(); ?>
</div>
