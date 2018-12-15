<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'НППК - ' . Yii::t('frontend', 'Employees');
$this->params['breadcrumbs'][] = $this->title;

$js = <<<JS
$('.ajax-popup-two').magnificPopup({
    type: 'ajax'
});
JS;

$this->registerJs($js);
?>
<div class="teacher-index">
	<?php $i = 0; ?>
	<?php if($teachers) { ?>
	<?php foreach($teachers as $teacher) { ?>
	<?php if($i == 0) echo '<div class="row">'; ?>
	<?php $i++; ?>
	<div class="col-md-2">
		<?= Html::a(Html::img($teacher->image->src, ['class' => 'img-responsive']), ['teacher/ajax-view', 'id' => $teacher->id], ['class' => 'ajax-popup-two', 'data-effect' => 'mfp-zoom-in']) ?>
	</div>
	
	<?php if($i >= 6) {echo '</div>'; $i = 0;} ?>
	<?php } ?>
	<?php } ?>
</div>
