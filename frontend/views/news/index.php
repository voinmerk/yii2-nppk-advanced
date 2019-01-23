<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'НППК - Новости';
?>
<div class="news-index">
	<div class="page-header">
		<h1>Новости</h1>
	</div>

	<div class="row">
		<?php 
			if ($news) {
				foreach ($news as $new) {
					echo $this->render('_news', ['new' => $new]);
				}
			}
		?>
	</div>
</div>
