<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;

use rmrevin\yii\fontawesome\FA;
use kidzen\dynamicform\DynamicFormWidget;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Banner */
/* @var $form yii\widgets\ActiveForm */

$js = '
jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapper .panel-title-caption").each(function(index) {
        jQuery(this).html("Баннер: " + (index + 1))
    });
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper .panel-title-caption").each(function(index) {
        jQuery(this).html("Баннер: " + (index + 1))
    });
});
';

$this->registerJs($js);
?>

<div class="banner-form box box-primary">
    <?php $form = ActiveForm::begin(['id' => 'banner-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'status')->dropDownList($model->getStatusList()) ?>

        <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapper',
            'widgetBody' => '.container-items',
            'widgetItem' => '.item', // required: css class
            'limit' => 999, // the maximum times, an element can be cloned (default 999)
            'min' => 0, // 0 or 1 (default 1)
            'insertButton' => '.add-item', // css class
            'deleteButton' => '.remove-item', // css class
            'model' => $modelCaptions[0],
            'formId' => 'banner-form',
            'formFields' => [
                'title',
                'status',
                'imageFile',
                'btn_caption',
                'btn_link',
                'btn_status',
            ],
        ]); ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                Баннеры
                <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> Добавить баннер</button>

                <div class="clearfix"></div>
            </div>
            <div class="panel-body container-items">
                <?php if($modelCaptions) { ?>
                <?php foreach ($modelCaptions as $index => $caption) { ?>
                    <?php
                        // necessary for update action.
                        if (!$caption->isNewRecord) {
                            echo Html::activeHiddenInput($caption, "[{$index}]id");
                        }
                    ?>

                    <?= $this->render('_caption', compact('form', 'caption', 'index')) ?>
                <?php } ?>
                <?php } ?>
            </div>
        </div>
        <?php DynamicFormWidget::end(); ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
