<?php

use yii\helpers\Html;
use yii\grid\GridView;
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
            'username:text:Логин',
           // 'auth_key',
           // 'password_hash',
           // 'password_reset_token',
            'email:email:Почта',

            'sit.sit',
            'role_id',
            'status',
            [
                'attribute' => 'created_at',
                'label'=>'Дата создания',
                'format' =>  ['date', 'dd.MM.Y HH:mm:ss'],
                'options' => ['width' => '200']
            ],
            [
                'attribute' => 'updated_at',
                'label'=>'Дата изменения',
                'format' =>  ['date', 'dd.MM.Y HH:mm:ss'],
                'options' => ['width' => '200']
            ],

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {link}',
                'buttons' => [
                    'update' => function ($url,$model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-screenshot"></span>',
                            $url);
                    },
                    'link' => function ($url,$model,$key) {
                        return Html::a('Действие', $url);
                    },
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
