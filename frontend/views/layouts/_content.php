<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<div id="content">
	<?php if (Yii::$app->controller->id !== 'site') { ?>
    <div class="container">

        <?= $content ?>

    </div>
	<?php } else { ?>

	<?= $content ?>

	<?php } ?>
</div>