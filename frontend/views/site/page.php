<?php

use yii\helpers\Html;

?>
<div class="site-page">
	<div class="page-header">
		<h1><?= $page->title ?></h1>
	</div>

	<div class="page-content">
		<?= Html::decode($page->content) ?>
	</div>
</div>