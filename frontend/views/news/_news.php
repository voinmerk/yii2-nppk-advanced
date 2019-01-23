<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="col-md-3">
	<div class="news-card">
		<div class="news-image">
			<?php if ($new->image) { ?>
			<?= Html::img('@web' . $new->image->src, ['class' => 'img-responsive']) ?>
			<?php } else { ?>
			<?= Html::img('@web/img/logo-reduct.png', ['class' => 'img-responsive']) ?>
			<?php } ?>
		</div>

		<h2 class="news-title">
			<?= Html::a(Html::encode($new->title), ['/news/view', 'id' => $new->slug]) ?>
		</h2>

		<div class="news-desc">
			<?= Html::decode($new->content) ?>
		</div>
	</div>
</div>