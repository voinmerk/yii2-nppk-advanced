<?php

use yii\helpers\Html;
?>

<div id="custom-content" class="white-popup-block panel panel-primary">
	<?php if(count($rooms)) { ?>
    <div class="panel-heading">
	    <h1><?= $rooms['number']; ?> <button title="Close (Esc)" type="button" class="mfp-close pull-right"><i class="fa fa-close"></i></button></h1>
	</div>
	<div class="panel-body">
	    <p><?= $rooms['name']; ?></p>
	   	<?php if(count($rooms_image)) { ?>
		<div class="slider slider-for">
			<?php foreach($rooms_image as $rimage) { ?>
			<div><?= Html::img('@web' . $rimage['image']['src']) ?></div>
			<?php } ?>
		</div>

		<div class="slider slider-nav">
			<?php foreach($rooms_image as $rimage) { ?>
			<?= Html::img('@web' . $rimage['image']['src']) ?>
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