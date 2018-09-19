<?php

use yii\helpers\Url;

$this->title = 'НППК - ' . Yii::t('frontend', 'Information') . ' - ' . $blog_title['name'];
?>

<div class="row">
	<div class="hidden-md hidden-lg col-md-3 sidebar wow fadeInRightBig animated" data-wow-duration="1s" data-wow-delay=".5s">
		<ul class="list-group">
			<?php foreach($blog_menu as $menu) { ?>
			<li class="list-group-item <?= ($active == $menu['slug']) ? 'active' : '' ?>" data-ajax="<?= $menu['slug'] ?>">
				<a href="<?= Url::toRoute(['blog/index', 'id' => $menu['slug']]) ?>"><?= $menu['name'] ?></a>
			</li>
			<?php } ?>
		</ul>
	</div>

	<div class="col-md-9 content wow fadeInUp animated" data-wow-duration=".5s" data-wow-delay="1s">
		<?php if(count($model)) { ?>
		<?php foreach($model as $item) { ?>

		<?php $description = html_entity_decode($item['description'], ENT_QUOTES, 'UTF-8'); ?>

		<?php if($item['slug'] == 'news') { ?>

		<div class="panel panel-primary">
			<div class="panel-heading">
				<h1><?= $item['name']; ?></h1>
			</div>

			<div id="new_<?= $item['blog_id']; ?>" class="panel-body thumbnails">
				<?= $description ?>
			</div>

			<?php if($item['cut']) { ?>
			<div class="panel-footer clearfix">
				<a class="pull-right btn btn-read-more dop" href="javascript: return false;" js-id="#new_<?php echo $item['blog_id']; ?>" ><?= Yii::t('frontend', 'Read more') ?></a>
			</div>
			<?php } ?>
		</div>
		
		<?php } else { ?>
		
		<div class="page-header">
			<h1><?= $item['name']; ?></h1>
		</div>

		<div class="page-body thumbnails">
			<?= $description ?>
		</div>

		<?php } ?>
		<?php } ?>
		<?php } else { ?>
		<div class="alert alert-danger"><?= Yii::t('frontend', 'No data to display content ;(') ?></div>
		<?php } ?>
	</div>
	
	<div class="hidden-xs hidden-sm col-md-3 sidebar wow fadeInRightBig animated" data-wow-duration="1s" data-wow-delay=".5s">
		<ul class="list-group">
			<?php foreach($blog_menu as $menu) { ?>
			<li class="list-group-item <?= ($active == $menu['slug']) ? 'active' : '' ?>" data-ajax="<?= $menu['slug'] ?>">
				<a href="<?= Url::toRoute(['blog/index', 'id' => $menu['slug']]) ?>"><?= $menu['name'] ?></a>
			</li>
			<?php } ?>
		</ul>
	</div>
</div>