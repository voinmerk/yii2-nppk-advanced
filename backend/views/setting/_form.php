<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Setting */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="setting-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'language_id')->textInput() ?>

        <?= $form->field($model, 'multilanguage')->textInput() ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('backend', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
