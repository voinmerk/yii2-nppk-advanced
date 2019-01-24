<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Html::encode($post->meta_title);

$this->registerMetaTag([
  'name' => 'description',
  'content' => Html::encode($post->meta_description),
]);

$this->registerMetaTag([
  'name' => 'keywords',
  'content' => Html::encode($post->meta_keywords),
]);

?>
<div class="post-view">
	<div class="page-header">
		<h1><?= Html::encode($post->title) ?></h1>
	</div>

	<div class="page-body clearfix">
		<div class="page-image">
			<?php if($post->image) { ?>
			<?= Html::img('@web' . $post->image->src, ['class' => 'img-responsive']) ?>
			<?php } else { ?>
			<?= Html::img('@web/img/no-image.jpg', ['class' => 'img-responsive']) ?>
			<?php } ?>
		</div>

		<?= Html::decode($post->content) ?>
	</div>
</div>
