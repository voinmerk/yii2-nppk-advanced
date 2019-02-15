<?php

use yii\helpers\Html;
use yii\web\JsExpression;

use common\models\Lesson;
use common\models\Room;

?>
<div class="item panel panel-default">
    <div class="panel-heading">
        <span class="panel-title-lesson">Занятие: <?= ($index + 1) ?></span>
        <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-7">
                <?= $form->field($lesson, "[{$index}]lesson")->widget(\yii\jui\AutoComplete::className(), [
                    'clientOptions' => [
				        'source' => $lessonData,
				        'model' => $lesson,
				        'attribute' => "[{$index}]lesson",
				        'autoFill'=>true,
				        'select' => new JsExpression("function( event, ui ) {
				            console.log(ui);
				            console.log('#timetablelesson-{$index}-lesson');
				            $('#timetablelesson-{$index}-lesson').val(ui.item.id);
				        }")
				    ],
                    'options' => [
                        'class' => 'form-control'
                    ],
                ]) ?>
            </div>
            <div class="col-sm-5">
                <?= $form->field($lesson, "[{$index}]room")->widget(\yii\jui\AutoComplete::className(), [
                    'clientOptions' => [
                        'source' => $roomData,
                        'autoFill' => true,
                    ],
                    'options' => [
                        'class' => 'form-control'
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>
