<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'НППК - ' . Yii::t('frontend', 'Rooms');
?>

<div class="content room-list">
	<?php if($rooms) { ?>

	<?php $column = 0; ?>
	<?php $class = 0; ?>
	<?php $data = 0; ?>

	<?php foreach($rooms as $room) { ?>

	<?php
	if($column == 0) {
		$class = 'fadeInLeftBig';
		$data = 'data-wow-duration="1s" data-wow-delay=".5s"';
	} else {
		$class = 'fadeInRightBig';
		$data = 'data-wow-duration="1s" data-wow-delay=".5s"';

		$column = -1;
	}
	?>

	<div id="room_<?= $room->id ?>" class="col-sm-6 col-md-6 wow <?= $class ?> animated" <?php echo $data; ?>>

		<div class="room-train">
			<h2><?= $room->title ?></h2>
			<p><?= $room->content ?></p>

			<a class="ajax-popup btn btn-read-more" data-effect="mfp-zoom-in" href="<?= Url::to(['site/rooms', 'id' => $room->id]) ?>"><?= Yii::t('frontend', 'Read More') ?></a>
		</div>

		<?= Html::img('@web' . $room->image->src, ['class' => 'room-train-image', 'title' => $room->image->title, 'alt' => $room->image->content]) ?>
	</div>

	<?php $column++; ?>

	<?php } ?>

	<?php } ?>
</div>
