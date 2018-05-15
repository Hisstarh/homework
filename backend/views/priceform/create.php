<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Priceform */

$this->title = Yii::t('app', 'Create Priceform');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Priceforms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="priceform-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
