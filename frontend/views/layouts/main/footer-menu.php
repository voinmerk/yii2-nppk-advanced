<?php

use yii\bootstrap\Html;
use yii\helpers\Url;

$blogs_menu = \frontend\models\BlogMenu::getMenu();

if (count($blogs_menu)) {
?>
<ul class="nav">
	<?php foreach ($blogs_menu as $bm) { ?>
	<li><a href="<?= Url::to(['blog/index', 'id' => $bm['slug']]) ?>"><?= $bm['name']; ?></a></li>
	<?php } ?>
</ul>
<?php } ?>