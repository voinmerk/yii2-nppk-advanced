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
        <?= $this->render($post->getTemplate($post->template), ['post' => $post]) ?>
	</div>

	<div class="hidden-xs hidden-sm col-md-3 sidebar wow fadeInRightBig animated" data-wow-duration="1s" data-wow-delay=".5s">
		<?= $this->render('_categories', ['categories' => $categories]) ?>
	</div>
</div>
