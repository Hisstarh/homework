<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Delevery */

$this->title = Yii::t('app', 'Create Delevery');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Deleveries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="delevery-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'filter_sit'=>$filter_sit,
        'filter_user'=>$filter_user,
    ]) ?>

</div>
