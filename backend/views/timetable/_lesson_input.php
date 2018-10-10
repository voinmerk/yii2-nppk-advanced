<?php

use yii\helpers\Html;
use yii\widgets\ActiveField;
use rmrevin\yii\fontawesome\FA;

$field = new ActiveField;

?>
<div class="form-group">
    <label>Урок 1</label>
    <div class="form-inline">
        <input type="text" id="input-lesson-1" name="lesson[]" value="" class="form-control">
        <input type="text" id="input-room-1" name="room[]" value="" class="form-control">
        <?= Html::button(FA::icon('times'), ['id' => 'btn-minus', 'class' => 'btn btn-danger btn-flat']) ?>
    </div>
</div>
<div class="form-group">
    <label>Урок 2</label>
    <div class="form-inline">
        <input type="text" id="input-lesson-2" name="lesson[]" value="" class="form-control">
        <input type="text" id="input-room-2" name="room[]" value="" class="form-control">
        <?= Html::button(FA::icon('times'), ['id' => 'btn-minus', 'class' => 'btn btn-danger btn-flat']) ?>
    </div>
</div>
<div class="form-group">
    <label>Урок 3</label>
    <div class="form-inline">
        <div class="form-group">
            <label for="input-lesson-3">Урок</label>
            <input type="text" id="input-lesson-3" name="lesson[]" value="" class="form-control">
        </div>
        <div class="form-group">
            <label for="input-room-3">Кабинет</label>
            <input type="text" id="input-room-3" name="room[]" value="" class="form-control">
        </div>
        <?= Html::button(FA::icon('times'), ['id' => 'btn-minus', 'class' => 'btn btn-danger btn-flat']) ?>
    </div>
</div>
