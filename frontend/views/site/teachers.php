<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'НППК - ' . Yii::t('frontend', 'Employees');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="teachers-page">
	<div class="thumbnails">
		<div class="page-header wow rotateInDownRight animated" data-wow-duration="1.5s" data-wow-delay=".1s">
			<h1><?= Yii::t('frontend', 'Management') ?></h1>
		</div>

		<div class="page-body">
		<?php if($leaders) { ?>
		<?php $i = 0; $r = 0; $wow = 0; $anim = 0; ?>
		<?php foreach($leaders as $leader) { ?>
			<?php $r++; ?>

			<?php if($i == 0) { ?>
			<div class="row">
			<?php } ?>

				<?php if($wow == 0) {
					$anim = 'fadeInLeftBig';
					$wow = 1;
				} else {
					$anim = 'fadeInRightBig';
					$wow = 0;
				} ?>
				<div class="col-xs-margin col-xs-12 col-sm-6 col-md-6">
					<div class="col-xs-margin col-xs-12 col-sm-6 col-md-6 wow <?php echo $anim; ?> animated" data-wow-duration="1s" data-wow-delay=".1s" special-area="1">
						<a class="thumbnail" data-effect="mfp-zoom-in" href="<?= Url::to('@web' . $leader->image->src) ?>" title="<?= $leader->image->title; ?>">
							<?= Html::img('@web' . $leader->image->src, ['title' => $leader->image->title, 'alt' => $leader->image->content]) ?>
						</a>
					</div>

					<div class="col-xs-12 col-sm-6 col-md-6 wow <?php echo $anim; ?> animated" data-wow-duration="1s" data-wow-delay=".1s">
						<h3><?= $leader->title; ?></h3>
						<?= Html::decode($leader->content) ?>
						<?php if($leader->room_id != 0) { ?>
						<a class="ajax-popup btn btn-primary btn-k" data-effect="mfp-zoom-in" href="<?= Url::to(['site/rooms', 'id' => $leader->room_id]) ?>"><?= $leader->room->title ?></a>
						<?php } ?>
					</div>
				</div>

			<?php if($i == 1 || $r == count($leaders)) { ?>
			</div>
			<?php } ?>

			<?php $i++; ?>
			<?php if($i > 1) $i = 0; ?>
		<?php } ?>
		<?php } else { ?>
			<div class="alert alert-danger">
				<p><i class="fa fa-exclamation-circle"></i> <?= Yii::t('frontend', 'No data to display content ;(') ?></p>
			</div>
		<?php } ?>
		</div>

		<div class="page-header wow rotateInDownLeft animated" data-wow-duration="1s" data-wow-delay=".1s">
			<h2><?= Yii::t('frontend', 'Master of production training') ?></h2>
		</div>

		<div class="page-body">
		<?php if(count($teachers)) { ?>
		<?php $i = 0; $r = 0; $wow = 0; $anim = 0; ?>
		<?php foreach($teachers as $teacher) { ?>
			<?php $r++; ?>

			<?php if($i == 0) { ?>
			<div class="row">
			<?php } ?>

				<?php if($wow == 0) {
					$anim = 'fadeInLeftBig';
					$wow = 1;
				} else {
					$anim = 'fadeInRightBig';
					$wow = 0;
				} ?>

				<div class="col-xs-margin col-xs-12 col-sm-6 col-md-6">
					<div class="col-xs-margin  col-xs-12 col-sm-6 col-md-6 wow <?php echo $anim; ?> animated" data-wow-duration="1s" data-wow-delay=".1s" special-area="1">
						<a class="thumbnail" data-effect="mfp-zoom-in" href="<?= Url::to('@web' . $teacher->image->src) ?>" title="<?= $teacher->image->title ?>">
							<?= Html::img('@web' . $teacher->image->src, ['title' => $teacher->image->title, 'alt' => $teacher->image->content]) ?>
						</a>
					</div>

					<div class="col-xs-12 col-sm-6 col-md-6 wow <?php echo $anim; ?> animated" data-wow-duration="1s" data-wow-delay=".1s">
						<h3><?php echo $teacher->title; ?></h3>
						<?= Html::decode($teacher->content) ?>
						<?php if($teacher->room_id != 0) { ?>
						<a class="ajax-popup btn btn-primary btn-k" data-effect="mfp-zoom-in" href="<?= Url::to(['site/rooms', 'id' => $teacher->room_id]) ?>"><?= $teacher->room->title ?></a>
						<?php } ?>
					</div>
				</div>

			<?php if($i == 1 || $r == count($teachers)) { ?>
			</div>
			<?php } ?>

			<?php $i++; ?>
			<?php if($i > 1) $i = 0; ?>
		<?php } ?>
		<?php } else { ?>
			<div class="alert alert-danger">
				<p><i class="fa fa-exclamation-circle"></i> <?= Yii::t('frontend', 'No data to display content ;(') ?></p>
			</div>
		<?php } ?>
		</div>
	</div>
</div>
