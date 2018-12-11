<?php

use yii\bootstrap\Html;
use yii\helpers\Url;
use frontend\models\Category;

$categories = Category::find()->where(['published' => Category::PUBLISHED])->all();

if ($categories) {
?>
<ul class="nav">
	<?php foreach ($categories as $category) { ?>
	<li><a href="<?= Url::to(['page/categ', 'id' => $category->slug]) ?>"><?= $category->title; ?></a></li>
	<?php } ?>
</ul>
<?php } ?>
