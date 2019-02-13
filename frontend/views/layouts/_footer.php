<?php

use yii\bootstrap\Html;
use yii\helpers\Url;

$categories = \common\models\Category::find()->where([
  'status' => \common\models\Category::STATUS_ACTIVE,
])->all();
?>
<footer id="footer">
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-md-6">
        <ul class="nav">
          <li><a href="<?= Url::to(['site/index']) ?>"><?= Yii::t('frontend', 'Home') ?></a></li>
          <li><a href="<?= Url::toRoute(['blog/index']) ?>"><?= Yii::t('frontend', 'Blog') ?></a></li>
          <li><a href="<?= Url::toRoute(['news/index']) ?>"><?= Yii::t('frontend', 'News') ?></a></li>
          <li><a href="<?= Url::to(['timetable/index']) ?>"><?= Yii::t('frontend', 'Timetable') ?></a></li>
          <li><a href="<?= Url::to(['room/index']) ?>"><?= Yii::t('frontend', 'Rooms') ?></a></li>
          <li><a href="<?= Url::to(['teacher/index']) ?>"><?= Yii::t('frontend', 'Teachers') ?></a></li>
          <!-- <li><a href="<?= Url::to('//nppk54.ru') ?>" title="nppk54.ru"><?= Yii::t('frontend', 'Our website') ?></a></li> -->
        </ul>
      </div>

      <hr class="hidden-sm hidden-md hidden-lg">

      <div class="col-sm-6 col-md-6">
        <?php if ($categories) { ?>
        <ul class="nav">
          <?php foreach ($categories as $category) { ?>
          <li><a href="<?= Url::to(['post/category', 'category' => $category->slug]) ?>"><?= $category->title; ?></a></li>
          <?php } ?>
        </ul>
        <?php } ?>
      </div>
  </div>

  <hr>

  <div class="row">
      <div class="col-xs-4 col-sm-3 col-md-5">
          <p class="text-left"><?= Yii::t('frontend', 'NPPK') ?> &copy; <?= date('Y') ?></p>
      </div>

      <div class="col-xs-8 col-sm-8 col-md-6">
          <p class="text-right"><?= Yii::t('frontend', 'Novosibirskiy professional\'no-pedagogicheskiy kolledzh') ?></p>
      </div>

      <div class="col-xs-12 col-sm-1 col-md-1">
          <a href="#" id="toTop" class="btn btn-default"><i class="fa fa-angle-up"></i></a>
      </div>
    </div>
  </div>
</footer>