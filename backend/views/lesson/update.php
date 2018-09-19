<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Lesson */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Lesson',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Lessons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="lesson-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
