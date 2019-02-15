<?php

use yii\helpers\Html;

?>
<div class="item panel panel-default">
    <div class="panel-heading">
        <span class="panel-title-caption">Баннер: <?= ($index + 1) ?></span>
        <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6">
                <?= $form->field($caption, "[{$index}]title")->textInput() ?>
            </div>
            <div class="col-sm-6">
                <?= $form->field($caption, "[{$index}]status")->dropDownList($caption->getStatusList()) ?>
            </div>
            <div class="col-sm-12">
                <?= $form->field($caption, "[{$index}]imageFile")->widget(\kartik\file\FileInput::classname(), [
                    'options' => ['accept' => 'image/*'],
                ]); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <?= $form->field($caption, "[{$index}]btn_caption")->textInput() ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($caption, "[{$index}]btn_link")->textInput() ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($caption, "[{$index}]btn_status")->dropDownList($caption->getStatusList()) ?>
            </div>
        </div>
    </div>
</div>
