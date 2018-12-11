<?php
use yii\helpers\Html;

$fa = new \rmrevin\yii\fontawesome\FontAwesome();
?>
<h3 class="box-title"><?= $title ?>
    <?php if(isset($smallTitle)) { ?>
    <small><?= $smallTitle ?></small>
    <?php } ?>
</h3>
<!-- tools box -->
<div class="pull-right box-tools">
    <?= Html::a($fa->icon('pencil'), $action_update, ['class' => 'btn btn-primary btn-flat', 'data-toogle' => 'tooltip', 'title' => Yii::t('yii', 'Update')]) ?>
    <?= Html::a($fa->icon('trash-o'), $action_delete, ['class' => 'btn btn-danger btn-flat', 'data-toogle' => 'tooltip', 'title' => Yii::t('yii', 'Delete'), 'data-confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'), 'method' => 'post']) ?>
</div>
<!-- /. tools -->