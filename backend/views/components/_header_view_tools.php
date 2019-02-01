<?php

use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;

?>
<div class="box-header">
	<?= Html::a(FA::icon('plus'), ['create'], ['class' => 'btn btn-success btn-flat']) ?>
	<?= Html::a(FA::icon('pencil'), ['update', 'id' => $id], ['class' => 'btn btn-primary btn-flat']) ?>
    <?= Html::a(FA::icon('trash-o'), ['delete', 'id' => $id], [
        'class' => 'btn btn-danger btn-flat',
        'data' => [
            'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
            'method' => 'post',
        ],
    ]) ?>
	<?= Html::a(FA::icon('reply'), ['index'], ['class' => 'btn btn-default btn-flat']) ?>
</div>