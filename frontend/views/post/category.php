<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Html::encode($category->meta_title);

$this->registerMetaTag([
  'name' => 'description',
  'content' => Html::encode($category->meta_description),
]);

$this->registerMetaTag([
  'name' => 'keywords',
  'content' => Html::encode($category->meta_keywords),
]);

?>
<div class="post-category">
	<div class="page-header">
		<h1><?= Html::encode($category->title) ?></h1>
	</div>

	<div class="row">
		<div class="col-md-3">
			<?= $this->render('_categories', [
				'categories' => $categories,
			]) ?>
		</div>

		<div class="col-md-9">
			<div class="row">
				<?php

					if ($posts) {

						foreach ($posts as $post) {

							echo $this->render('_post', ['post' => $post]);

						}

					} else { ?>
						<div class="col-lg-12">
							<div class="alert alert-danger">
								<p>В данной рубрике недобавлены статьи!</p>
							</div>
						</div>
					<?php }

				?>
			</div>
		</div>
	</div>
</div>
