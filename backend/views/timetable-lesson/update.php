<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TimetableLesson */

$this->title = 'Update Timetable Lesson: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Timetable Lessons', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="timetable-lesson-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
