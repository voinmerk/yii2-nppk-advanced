<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
use kartik\file\FileInput;

use common\models\Category;

/* @var $this yii\web\View */
/* @var $model backend\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form box box-primary">
    <?php $form = ActiveForm::begin([
        // 'enableClientValidation' => false,
        'options' => [
            'enctype' => 'multipart/form-data',
        ],
    ]); ?>
    <div class="box-body table-responsive">
        
        <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?=  $form->field($model, 'content')->widget(TinyMce::className(), [
            'options' => ['rows' => 24],
            'language' => 'ru',
            'value' => Html::decode($model->content),
            'clientOptions' => [
                'file_browser_callback' => new \yii\web\JsExpression("function(field_name, url, type, win) {
                    window.open('".\yii\helpers\Url::to(['imagemanager/manager', 'view-mode'=>'iframe', 'select-type'=>'tinymce'])."&tag_name='+field_name,'','width=800,height=540 ,toolbar=no,status=no,menubar=no,scrollbars=no,resizable=no');
                }"),
                'plugins' => [
                    'advlist autolink lists link charmap  print hr preview pagebreak',
                    'searchreplace wordcount textcolor visualblocks visualchars code fullscreen nonbreaking',
                    'save insertdatetime media table contextmenu template paste image'
                ],
                'toolbar' => 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code'
            ]
        ]); ?>

        <?= $form->field($model, 'category_ids')->dropDownList(ArrayHelper::map(Category::getCategoryList(), 'id', 'title'), ['multiple' => 'multiple']) ?>

        <?php // $form->field($model, 'image_file')->fileInput() ?>

        <?= $form->field($model, 'imageFile')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
        ]); ?>

        <?= $form->field($model, 'slug')->textInput() ?>

        <?= $form->field($model, 'meta_keywords')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'meta_description')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'status')->dropDownList($model->getStatusList()) ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
