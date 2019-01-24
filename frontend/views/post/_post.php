<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;

?>
<div class="col-md-4">
	<div class="post-card">
		<div class="post-image">
			<?php if($post->image) { ?>
			<?= Html::img('@web' . $post->image->src, ['class' => 'img-responsive']) ?>
			<?php } else { ?>
			<?= Html::img('@web/img/no-image.jpg', ['class' => 'img-responsive']) ?>
			<?php } ?>
		</div>

		<h2 class="post-title">
			<?= Html::a(StringHelper::truncate(Html::encode($post->title), 18), [
				'/post/view',
				'category' => isset($category) ? $category->slug : $post->category->slug,
				'post' => $post->slug
			], ['title' => Html::encode($post->title)]) ?>
		</h2>
	</div>
</div>
