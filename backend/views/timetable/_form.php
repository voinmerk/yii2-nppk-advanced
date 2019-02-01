<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use rmrevin\yii\fontawesome\FA;
use backend\models\TimetableLesson;
use wbraganca\dynamicform\DynamicFormWidget;

use kartik\date\DatePicker;

use backend\models\Lesson;
use backend\models\Room;

/* @var $this yii\web\View */
/* @var $model backend\models\Timetable */
/* @var $form yii\widgets\ActiveForm */

$js = '
jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapper .panel-title-lesson").each(function(index) {
        jQuery(this).html("Lesson: " + (index + 1))
    });
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper .panel-title-lesson").each(function(index) {
        jQuery(this).html("Lesson: " + (index + 1))
    });
});
';

$this->registerJs($js);
?>

<div class="timetable-form box box-primary">
    <?php $form = ActiveForm::begin(['id' => 'timetable-form']); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'date')->widget(DatePicker::className(), [
            'type' => DatePicker::TYPE_INPUT,
            'value' => $model->date,
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd'
            ]
        ]) ?>

        <?= $form->field($model, 'group_id')->dropDownList($model->getGroupList(), ['prompt' => '-- Выбор группы --']) ?>

        <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapper',
            'widgetBody' => '.container-items',
            'widgetItem' => '.item', // required: css class
            'limit' => 4, // the maximum times, an element can be cloned (default 999)
            'min' => 0, // 0 or 1 (default 1)
            'insertButton' => '.add-item', // css class
            'deleteButton' => '.remove-item', // css class
            'model' => $modelLessons[0],
            'formId' => 'timetable-form',
            'formFields' => [
                'lesson_id',
                'room_id',
                'sort_order',
            ],
        ]); ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                Занятия
                <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> Добавить пару</button>

                <div class="clearfix"></div>
            </div>
            <div class="panel-body container-items">
                <?php if($modelLessons) { ?>
                <?php foreach ($modelLessons as $index => $lesson) { ?>
                    <?php
                        // necessary for update action.
                        if (!$lesson->isNewRecord) {
                            echo Html::activeHiddenInput($lesson, "[{$index}]id");
                        }
                    ?>
                    <div class="item panel panel-default">
                        <div class="panel-heading">
                            <span class="panel-title-lesson">Занятие: <?= ($index + 1) ?></span>
                            <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-5">
                                    <?= $form->field($lesson, "[{$index}]lesson_id")->dropDownList(ArrayHelper::map(Lesson::find()->select(['id', 'name'])->where(['published' => 1])->all(), 'id', 'name')) ?>
                                </div>
                                <div class="col-sm-5">
                                    <?= $form->field($lesson, "[{$index}]room_id")->dropDownList(ArrayHelper::map(Room::find()->select(['id', 'title'])->where(['published' => 1])->all(), 'id', 'title')) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php } ?>
            </div>
        </div>
        <?php DynamicFormWidget::end(); ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
