<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TimetableLesson */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="timetable-lesson-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'timetable_id')->textInput() ?>

        <?= $form->field($model, 'lesson_id')->textInput() ?>

        <?= $form->field($model, 'room_id')->textInput() ?>

        <?= $form->field($model, 'sort_order')->textInput() ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
