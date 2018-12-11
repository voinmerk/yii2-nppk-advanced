<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'НППК - Новости';
?>
<div class="row">
	<div class="col-md-12 content wow fadeInUp animated" data-wow-duration=".5s" data-wow-delay="1s">
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
</div>

<div class="content groups-list">
	<?php $i = 0; $e = $newsCount; ?>
	<?php $wow = 0; $anim = 0; ?>
	<?php foreach($news as $new) { ?>

	<?php if($i == 0) { ?>
	<?php if($wow == 0) {
		$anim = 'fadeInLeftBig';
		$wow = 1;
	} else {
		$anim = 'fadeInRightBig';
		$wow = 0;
	} ?>
	<div class="row wow <?= $anim ?> animated" data-wow-duration="2s" data-wow-delay=".1s" special-area="1">
	<?php } ?>

		<div class="col-xs-margin-25 col-xs-12 col-sm-3 col-md-3">
			<a class="ajax-popup btn btn-primary" data-effect="mfp-zoom-in" href="<?= Url::toRoute(['site/timetable', 'id' => $new->id]) ?>"><?= $new->name ?></a>
		</div>

	<?php $i ++; ?>

	<?php if($i == 4) { ?>
	</div>
	<?php $i = 0; ?>
	<?php } ?>

	<?php $e--; ?>

	<?php if($e == 0 && ($i > 0 && $i < 4)) { ?>
	</div>
	<?php } ?>

	<?php } ?>
</div>
