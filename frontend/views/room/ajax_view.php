<?php

use yii\helpers\Html;

?>

<div id="custom-content" class="white-popup-block panel panel-primary">
	<?php if($room) { ?>
    <div class="panel-heading">
	    <h1><?= $room->title; ?> <button title="Close (Esc)" type="button" class="mfp-close pull-right"><i class="fa fa-close"></i></button></h1>
	</div>
	<div class="panel-body">
	    <p><?= $room->content; ?></p>
	   	<?php if($room->images) { ?>
		<div class="slider slider-for">
			<?php foreach($room->images as $image) { ?>
			<div><?= Html::img('@web' . $image->src, ['title' => $image->title, 'alt' => $image->content]) ?></div>
			<?php } ?>
		</div>

		<div class="slider slider-nav">
			<?php foreach($room->images as $image) { ?>
			<?= Html::img('@web' . $image->src, ['title' => $image->title, 'alt' => $image->content]) ?>
			<?php } ?>
		</div>

		<script type="text/javascript">
			$('.slider-for').slick({
			  slidesToShow: 1,
			  slidesToScroll: 1,
			  arrows: false,
			  fade: true,
			  asNavFor: '.slider-nav'
			});
			$('.slider-nav').slick({
			  slidesToShow: 3,
			  slidesToScroll: 1,
			  asNavFor: '.slider-for',
			  dots: true,
			  centerMode: true,
			  focusOnSelect: true
			});
		</script>
		<?php } ?>
	</div>
	<?php } ?>
</div>
