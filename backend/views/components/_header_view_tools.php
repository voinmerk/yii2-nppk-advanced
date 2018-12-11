<?php

use yii\helpers\Html;

$fa = new \rmrevin\yii\fontawesome\FontAwesome();

?>
<div class="box-header">
	<?= Html::a($fa->icon('pencil'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-flat']) ?>
    <?= Html::a($fa->icon('trash-o'), ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger btn-flat',
        'data' => [
            'confirm' => 'Are you sure you want to delete this item?',
            'method' => 'post',
        ],
    ]) ?>
</div>