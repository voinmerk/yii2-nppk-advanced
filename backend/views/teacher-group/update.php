<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TeacherGroup */

$this->title = 'Update Teacher Group: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Teacher Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="teacher-group-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
