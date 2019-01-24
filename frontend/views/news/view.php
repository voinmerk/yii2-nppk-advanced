<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $new->meta_title;
?>
<div class="news-view">
	<div class="page-header">
		<h2><?= Html::encode($new->title) ?></h2>
	</div>

	<div class="page-body">
		<div class="page-image">
			<?php if ($new->image) { ?>
			<?= Html::img('@web' . $new->image->src, ['class' => 'img-responsive']) ?>
			<?php } else { ?>
			<?= Html::img('@web/img/logo-reduct.png', ['class' => 'img-responsive']) ?>
			<?php } ?>
		</div>

		<?= Html::decode($new->content) ?>
	</div>
</div>
