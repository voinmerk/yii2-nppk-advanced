<?php

use yii\helpers\Html;
use yii\helpers\Url;

use valiant\widgets\ListGroupWidget;

$request = Yii::$app->request;

$menuItems = [];

if($categories) {
  foreach($categories as $category) {
    $menuItems[] = [
      'label' => $category->title,
      'url' => ['/post/category', 'category' => $category->slug],
    ];
  }
}

$menuItems[] = [
	'label' => 'Все рубрики',
	'url' => ['/post/index'],
];

?>
<div class="categories">
	<?= ListGroupWidget::widget([
		'items' => $menuItems,
	]) ?>
</div>
