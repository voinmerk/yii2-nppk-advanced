<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'НППК - ' . $category->title;
?>
<div class="row">
	<div class="col-md-3 sidebar wow fadeInLeftBig animated" data-wow-duration="1s" data-wow-delay=".5s">
		<?= $this->render('_categories', ['categories' => $categories]) ?>
	</div>

	<div class="col-md-9 content wow fadeInUp animated" data-wow-duration=".5s" data-wow-delay="1s">
		<?php if($posts) {
			foreach($posts as $post) {
				echo $this->render('_post', ['post' => $post]);
			}
		} ?>
	</div>
</div>
