<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TimetableLesson */

$this->title = 'Create Timetable Lesson';
$this->params['breadcrumbs'][] = ['label' => 'Timetable Lessons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timetable-lesson-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
