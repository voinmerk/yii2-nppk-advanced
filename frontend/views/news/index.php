<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'НППК - Новости';
?>
<div class="row">
	<?php if($news) { ?>
		<?php foreach($news as $new) { ?>
			<div class="col-md-3">
				<div class="panel panel-primary">
				    <div class="panel-heading">
				        <h2 class="panel-title"><?= $new->title ?></h2>
				    </div>

				    <div id="new_<?= $new->id; ?>" class="panel-body thumbnails">

				        <?= Html::decode($new->content) ?>
				    </div>

				    <div class="panel-footer clearfix">
				        <?= html::a(Yii::t('frontend', 'Read more'), Url::to(['news/view', 'news' => $new->slug]), ['class' => 'pull-right btn btn-link']) ?>
				    </div>
				</div>
			</div>
		<?php } ?>
	<?php } ?>
</div>
