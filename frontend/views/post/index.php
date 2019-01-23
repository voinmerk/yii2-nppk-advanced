<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Рубрики';

$this->registerMetaTag([
  'name' => 'description',
  'content' => '',
]);

$this->registerMetaTag([
  'name' => 'keywords',
  'content' => '',
]);

?>
<div class="post-index">
	<div class="page-header">
		<h1><?= Html::encode('Все рубрики') ?></h1>
	</div>

	<div class="row">
		<div class="col-md-4">
			<?= $this->render('_categories', [
				'categories' => $categories,
			]) ?>
		</div>

		<div class="col-md-8">
			<?php

				if ($posts) {

					foreach ($posts as $post) {

						echo $this->render('_post', ['post' => $post]);

					}

				}

			?>
		</div>
	</div>
</div>
