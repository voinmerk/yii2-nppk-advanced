<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'НППК - ' . Yii::t('frontend', 'Information') . ' - Новости';
?>
<div class="row">
	<div class="hidden-md hidden-lg col-md-3 sidebar wow fadeInRightBig animated" data-wow-duration="1s" data-wow-delay=".5s">
		<?= $this->render('_categories', ['categories' => $categories]) ?>
	</div>

	<div class="col-md-9 content wow fadeInUp animated" data-wow-duration=".5s" data-wow-delay="1s">
		<pre><?= var_dump($posts) ?></pre>

		<?php if($posts) { ?>
			<?php foreach($posts as $post) { ?>
				<div class="panel panel-primary">
				    <div class="panel-heading">
				        <h2><?= $post->title ?></h2>
				    </div>

				    <div id="new_<?= $post->id; ?>" class="panel-body thumbnails">

				        <?= Html::decode($post->content) ?>
				    </div>

				    <div class="panel-footer clearfix">
				        <?= html::a(Yii::t('frontend', 'Read more'), Url::to(['blog/view', 'post' => $post->slug]), ['class' => 'pull-right btn btn-read-more']) ?>
				    </div>
				</div>
			<?php } ?>
		<?php } ?>
	</div>

	<div class="hidden-xs hidden-sm col-md-3 sidebar wow fadeInRightBig animated" data-wow-duration="1s" data-wow-delay=".5s">
		<?= $this->render('_categories', ['categories' => $categories]) ?>
	</div>
</div>
