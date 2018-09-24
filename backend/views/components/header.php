<?php
use yii\helpers\Html;

$fa = new \rmrevin\yii\fontawesome\FontAwesome();
?>
<div class="pull-right">
    <?= Html::a($fa->icon('plus'), $action_create, ['class' => 'btn btn-success btn-flat', 'data-toogle' => 'tooltip', 'title' => Yii::t('backend', 'Added')]) ?>
    <?= Html::submitButton($fa->icon('trash-o'), ['form' => $form_id, 'formaction' => $action_copy, 'class' => 'btn btn-danger', 'data-toogle' => 'tooltip', 'title' => Yii::t('yii', 'Delete'), 'data-confirm' => 'Вы уверены, что хотите удалить выбранный(е) элементы(ы)?']) ?>
    <?= Html::button($fa->icon('files-o'), ['form' => $form_id, 'formaction' => $action_delete, 'class' => 'btn btn-default', 'data-toogle' => 'tooltip', 'title' => Yii::t('yii', 'Copy'), 'data-confirm' => 'Вы уверены, что хотите копировать выбранный(е) элемент(ы)?']) ?>
</div>