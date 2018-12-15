<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<style type="text/css">
	.popup-dialog {
		max-width: 800px;
		margin: 20px auto;
		background: #FFF;
		padding: 0;
		line-height: 0;
	}

	.popup-dialog h1 {
		font-size: 24px;
	}
</style>

<div id="custom-content" class="popup-dialog">
	<button title="<?= Yii::t('frontend', 'Close (Esc)') ?>" type="button" class="mfp-close pull-right"><i class="fa fa-close"></i></button>

	<div class="row">
		<div class="col-md-5">
			<?= Html::img($teacher->image->src, ['class' => 'img-responsive']) ?>
		</div>

		<div class="col-md-7">
			<h1><?= $teacher->title ?></h1>
		</div>
	</div>
</div>