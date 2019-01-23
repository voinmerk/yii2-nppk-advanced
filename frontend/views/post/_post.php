<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="col-md-4">
	<div class="post-card">
		<div class="post-image">
			<?php if($post->image) { ?>
			<?= Html::img('@web' . $post->image->src, ['class' => 'img-responsive']) ?>
			<?php } else { ?>
			<?= Html::img('@web/img/logo-reduct.png', ['class' => 'img-responsive']) ?>
			<?php } ?>
		</div>

		<div class="post-title">
			<h2>
				<?= Html::a(Html::encode($post->title), [
					'/post/view',
					'category' => isset($category) ? $category->slug : $post->category->slug,
					'post' => $post->slug
				]) ?>
			</h2>
		</div>
	</div>
</div>
