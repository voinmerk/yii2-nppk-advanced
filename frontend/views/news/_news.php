<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;

?>
<div class="col-md-3">
	<div class="news-card">
		<div class="news-image">
			<?php if ($new->image) { ?>
			<?= Html::img('@web' . $new->image->src, ['class' => 'img-responsive']) ?>
			<?php } else { ?>
			<?= Html::img('@web/img/no-image.jpg', ['class' => 'img-responsive']) ?>
			<?php } ?>
		</div>

		<h2 class="news-title">
			<?= Html::a(StringHelper::truncate(Html::encode($new->title), 18), ['/news/view', 'id' => $new->slug]) ?>
		</h2>

		<div class="news-desc">
			<?= StringHelper::truncate($new->content, 300) ?>
		</div>
	</div>
</div>