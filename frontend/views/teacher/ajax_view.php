<?php

use yii\helpers\Html;
use yii\helpers\Url;
use rmrevin\yii\fontawesome\FA;

?>
<div id="custom-content" class="teacher-dialog">
	<div class="row">
		<div class="col-md-5">
			<?= Html::img($teacher->image->src, ['class' => 'img-responsive']) ?>
		</div>

		<div class="col-md-7">
			<?= Html::button(FA::icon('close'), ['title' => Yii::t('frontend', 'Close (Esc)'), 'class' => 'mfp-close pull-right']) ?>
			<h1><?= $teacher->title ?></h1>

			<div class="teacher-content">
				<?= Html::decode($teacher->content) ?>
			</div>
		</div>
	</div>
</div>