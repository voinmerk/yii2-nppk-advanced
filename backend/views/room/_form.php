<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model backend\models\Room */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="room-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?=  $form->field($model, 'content')->widget(TinyMce::className(), [
            'options' => ['rows' => 12],
            'language' => 'ru',
            'clientOptions' => [
                'plugins' => [
                    'advlist autolink lists link charmap  print hr preview pagebreak',
                    'searchreplace wordcount textcolor visualblocks visualchars code fullscreen nonbreaking',
                    'save insertdatetime media table contextmenu template paste image'
                ],
                'toolbar' => 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image'
            ]
        ]); ?>

        <?= $form->field($model, 'sort_order')->textInput() ?>

        <?= $form->field($model, 'status')->dropDownList($model->getStatusList()) ?>

        <?= $form->field($model, 'image_id')->textInput() ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
