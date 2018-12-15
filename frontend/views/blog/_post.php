<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="post">
    <div class="post-header">
        <h2><?= $post->title ?></h2>
    </div>

    <div class="post-content thumbnails">

        <?= Html::decode($post->content) ?>
    </div>

    <div class="post-footer clearfix">
        <?= html::a(Yii::t('frontend', 'Read more'), Url::to(['blog/view', 'category' => $post->category->slug, 'post' => $post->slug]), ['class' => 'pull-right btn btn-link']) ?>
    </div>
</div>