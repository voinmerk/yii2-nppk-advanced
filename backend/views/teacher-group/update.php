<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TeacherGroup */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Teacher Group',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Teacher Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="teacher-group-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
