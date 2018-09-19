<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Teacher */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Teacher',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Teachers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="teacher-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
