<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Room */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Room',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Rooms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="room-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
