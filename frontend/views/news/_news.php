<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h2><?= $post->title ?></h2>
    </div>

    <div id="new_<?= $post->id; ?>" class="panel-body thumbnails">

        <?= Html::decode($post->content) ?>
    </div>

    <div class="panel-footer clearfix">
        <?= html::a(Yii::t('frontend', 'Read more'), Url::to(['blog/view', 'post' => $post->slug]), ['class' => 'pull-right btn btn-read-more']) ?>
    </div>
</div>
