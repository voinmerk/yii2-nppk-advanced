<?php

use yii\helpers\Html;

$fa = new \rmrevin\yii\fontawesome\FontAwesome();

?>
<div class="box-header with-border">
	<div class="pull-right">
		<?= Html::a($fa->icon('plus'), ['create'], ['class' => 'btn btn-success btn-flat', 'data-toogle' => 'tooltip', 'title' => Yii::t('backend', 'Added')]) ?>
	</div>
</div>