<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Timetable */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="timetable-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'date')->widget(DateTimePicker::className(), [
            'language' => 'ru',
            'size' => 'ms',
            'template' => '{input}',
            'pickButtonIcon' => 'glyphicon glyphicon-time',
            'inline' => true,
            'clientOptions' => [
                'startView' => 1,
                'minView' => 0,
                'maxView' => 1,
                'autoclose' => true,
                'linkFormat' => 'dd MM yyyy', // if inline = true
                'format' => 'dd MM yyyy',
                'todayBtn' => true
            ]
        ]) ?>

        <?= $form->field($model, 'group_id')->dropDownList($groupList, ['prompt' => Yii::t('backend', 'Selected group...')]) ?>

        <?= $form->field($modelLesson, 'lesson_id')->dropDownList($lessonList, ['prompt' => Yii::t('backend', 'Selected group...')])->label(Yii::t('backend', 'Lesson')) ?>

        <?= $form->field($modelLesson, 'room_id')->dropDownList($roomList, ['prompt' => Yii::t('backend', 'Selected group...')])->label(Yii::t('backend', 'Room')) ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
