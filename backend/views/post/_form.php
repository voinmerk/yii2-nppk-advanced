<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;

use backend\models\Category;

/* @var $this yii\web\View */
/* @var $model backend\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form box box-primary">
    <?php $form = ActiveForm::begin([
        'enableClientValidation' => false,
        'options' => [
            'enctype' => 'multipart/form-data',
        ],
    ]); ?>
    <div class="box-body table-responsive">
        
        <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>

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

        <?= $form->field($model, 'category_ids')->dropDownList(ArrayHelper::map(Category::getCategoryList(), 'id', 'title'), ['multiple' => 'multiple']) ?>

        <?= $form->field($model, 'image_file')->fileInput() ?>

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
