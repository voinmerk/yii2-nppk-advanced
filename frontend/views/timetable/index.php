<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'НППК - Расписание занятий';
$this->params['breadcrumbs'][] = $this->title;

$js = <<<JS
$('.ajax-popup').magnificPopup({
    type: 'ajax'
});
JS;

$this->registerJs($js);

?>
<div class="content groups-list">
	<?php $i = 0; $e = $groupCount; ?>
	<?php $wow = 0; $anim = 0; ?>
	<?php foreach($groups as $group) { ?>

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
			<!-- <a class="ajax-popup btn btn-primary" data-effect="mfp-zoom-in" href="<?= Url::toRoute(['timetable/ajax-view', 'id' => $group->id]) ?>"><?= $group->name ?></a> -->

			<?= Html::a($group->name, ['/timetable/view', 'id' => $group->id], ['class' => 'btn btn-primary']) ?>
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
