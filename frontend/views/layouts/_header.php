<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Menu;

/*Navbar::begin();

echo Nav::widget([
    'items' => [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'About', 'url' => ['/site/about']],
    ],
    'options' => ['class' => 'navbar-nav'],
]);

Navbar::end();*/

$isActive = function ($controller, $action = null) {

  if(Yii::$app->controller->id == $controller && Yii::$app->controller->action->id == $action) return true;

  if(Yii::$app->controller->id == $controller) return true;

  return false;
};
?>
<div class="new-menu">
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-slide-menu" aria-expanded="false">
          <span class="sr-only"><?= Yii::t('frontend', 'Open menu') ?></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>

        <a class="navbar-brand navbar-img wow fadeIn animated" data-wow-duration="2s" data-wow-delay="1s" href="<?= Url::to(['site/index']) ?>">
          <?= Html::img('@web/img/logo.png', ['alt' => Yii::t('frontend', 'Novosibirskiy professional\'no-pedagogicheskiy kolledzh')]) ?>
        </a>
      </div>

      <div class="collapse navbar-collapse" id="main-slide-menu">
        <?= Menu::widget([
            'options' => ['class' => 'nav navbar-nav wow fadeInLeftBig animated', 'data-wow-duration' => '.5s', 'data-wow-delay' => '.25s'],
            'items' => [
              ['label' => Yii::t('frontend', 'Blog'), 'url' => ['post/index'], 'active' => $isActive('post')],
              ['label' => Yii::t('frontend', 'News'), 'url' => ['news/index'], 'active' => $isActive('news')],
              ['label' => Yii::t('frontend', 'Timetable'), 'url' => ['timetable/index'], 'active' => $isActive('timetable')],
              ['label' => Yii::t('frontend', 'Rooms'), 'url' => ['room/index'], 'active' => $isActive('room')],
              ['label' => Yii::t('frontend', 'Employees'), 'url' => ['teacher/index'], 'active' => $isActive('teacher')],
            ],
            'activeCssClass' => 'active',
        ]); ?>

        <!-- <ul class="nav navbar-nav wow fadeInLeftBig animated" data-wow-duration=".5s" data-wow-delay=".25s">
          <li><a href="<?= Url::to('//nppk54.ru') ?>"><i class="fa fa-globe"></i> <?= Yii::t('frontend', 'Our website') ?></a></li>
        </ul> -->

        <ul class="nav navbar-nav navbar-right wow fadeInRightBig animated" data-wow-duration="1s" data-wow-delay=".5s">
          <li>
              <a href="#" id="spec_show">
                  <i class="fa fa-wheelchair"></i> <span><?= Yii::t('frontend', 'For the visually impaired') ?></span>
              </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</div>