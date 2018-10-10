<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use backend\models\TimetableLesson;

/* @var $this yii\web\View */
/* @var $model backend\models\Timetable */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="timetable-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'date')->textInput() ?>

        <?= $form->field($model, 'group_id')->dropDownList($model->getGroupList(), ['prompt' => '-- Выбор группы --']) ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Занятия</h4>
            </div>
            <div class="panel-body">
                <?= $this->render('_lesson_input', ['lessonList' => TimetableLesson::getLessonList(), 'roomList' => TimetableLesson::getRoomList()]) ?>
            </div>
            <div class="panel-footer clearfix">
                <?= Html::button(FA::icon('plus'), ['id' => 'btn-plus', 'class' => 'btn btn-success btn-flat pull-right']) ?>
            </div>
        </div>

    </div>
    <div class="box-footer">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
