<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Setting */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Setting',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="setting-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
