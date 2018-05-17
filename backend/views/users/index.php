<?php

use yii\helpers\Html;
use kartik\grid\GridView;//yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Users'), ['create'], ['class' => 'btn btn-success']) ?>
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
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'username',
                'label'=>'Логин',
                //'pageSummary' => 'Page Total',
                'vAlign'=>'middle',
                'headerOptions'=>['class'=>'kv-sticky-column'],
                'contentOptions'=>['class'=>'kv-sticky-column'],
                'editableOptions'=>['header'=>'Name', 'size'=>'md']

            ],

            // 'auth_key',
           // 'password_hash',
           // 'password_reset_token',
            'email:email:Почта',

            [
                'attribute' => 'sit.sit',
                'label'=>'Магазин'

            ],
            [
                'attribute' => 'role.name',
                'label'=>'Роль'

            ],
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
                'attribute' => 'created_at',
                'label'=>'Дата создания',
                'format' =>  ['date', 'dd.MM.Y HH:mm:ss'],
                'options' => ['width' => '140']
            ],
            [
                'attribute' => 'updated_at',
                'label'=>'Дата изменения',
                'format' =>  ['date', 'dd.MM.Y HH:mm:ss'],
                'options' => ['width' => '140']
            ],

//            ['class' => 'yii\grid\ActionColumn',
//                'template' => '{view} {update} {delete} {link}',
//                'buttons' => [
//                    'update' => function ($url,$model) {
//                        return Html::a(
//                            '<span class="glyphicon glyphicon-screenshot"></span>',
//                            $url);
//                    },
//                    'link' => function ($url,$model,$key) {
//                        return Html::a('Действие', $url);
//                    },
//                ],
//            ],
            [
                'class' => 'kartik\grid\ActionColumn',
                'dropdown' => true,
                'vAlign'=>'middle',
               // 'label'=>'Действия',
                'urlCreator' => function($action, $model, $key, $index) { return '#'; },
                'viewOptions'=>['title'=>$viewMsg, 'data-toggle'=>'tooltip'],
                'updateOptions'=>['title'=>$updateMsg, 'data-toggle'=>'tooltip'],
                'deleteOptions'=>['title'=>$deleteMsg, 'data-toggle'=>'tooltip'],
            ],
            ['class' => 'kartik\grid\CheckboxColumn']
        ],
        'containerOptions' => ['style'=>'overflow: auto'], // only set when $responsive = false
        'beforeHeader'=>[
            [
                'columns'=>[
                    ['content'=>'Header Before 1', 'options'=>['colspan'=>4, 'class'=>'text-center warning']],
                    ['content'=>'Header Before 2', 'options'=>['colspan'=>4, 'class'=>'text-center warning']],
                    ['content'=>'Header Before 3', 'options'=>['colspan'=>3, 'class'=>'text-center warning']],
                ],
                'options'=>['class'=>'skip-export'] // remove this row from export
            ]
        ],
        'toolbar' =>  [
//            ['content'=>
//                Html::button('&lt;i class="glyphicon glyphicon-plus">&lt;/i>', ['type'=>'button', 'title'=>Yii::t('kvgrid', 'Add Book'), 'class'=>'btn btn-success', 'onclick'=>'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
//                Html::a('&lt;i class="glyphicon glyphicon-repeat">&lt;/i>', ['grid-demo'], ['data-pjax'=>0, 'class' => 'btn btn-default', 'title'=>Yii::t('kvgrid', 'Reset Grid')])
//            ],
            '{export}',
            '{toggleData}'
        ],
        'pjax' => true,
        'bordered' => true,
        'striped' => false,
        'condensed' => false,
        'responsive' => true,
        'hover' => true,
        'floatHeader' => true,
        'floatHeaderOptions' => ['scrollingTop' => $scrollingTop],
        'showPageSummary' => false,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY
        ],

    ]); ?>
    <?php Pjax::end(); ?>
</div>
