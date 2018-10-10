<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
// use mihaildev\ckeditor\CKEditor;
use marqu3s\summernote\Summernote;

/* @var $this yii\web\View */
/* @var $model backend\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?php echo $form->field($model, 'content')->widget(Summernote::className(), [
            'uploadToS3' => true,
            'signEndpoint' => Url::to(['/post/sign-aws-request', 'v4' => true]),
            'bucket' => 'S3-BUCKET-NAME',
            //'folder' => '',
            'folder' => new \yii\web\JsExpression("function() { return $('#aFormFieldId').val() + '/'; }"),
            'filenamePrefix' => "'{$model->id}-'",
            'maxFileSize' => 1024000,
            'expiration' => gmdate('Y-m-d\TH:i:s.000\Z', strtotime('+5 minutes')),
            'clientOptions' => [
                'placeholder' => 'Hello stand alone ui',
                'tabsize' => 4,
                'height' => 500,
            ],
        ]); ?>

        <?= $form->field($model, 'fixed')->dropDownList($model->getFixedList()) ?>

        <?= $form->field($model, 'template')->dropDownList($model->getTemplateList(), ['prompt' => '-- Выбор шаблона --']) ?>

        <?= $form->field($model, 'published')->dropDownList($model->getStatusList()) ?>

        <?= $form->field($model, 'category_id')->dropDownList($model->getCategoryList(), ['prompt' => '-- Выбор категории --']) ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
