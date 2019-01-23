<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

?>
<div id="spec_tools" class="special-tools st-top" style="display: none;">
  <nav class="navbar navbar-default navbar-fixed-bottom">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#special-slide-menu" aria-expanded="false">
          <span class="sr-only"><?= Yii::t('frontend', 'Open menu') ?></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>

        <a class="navbar-brand" href="javascript: return false;"><i class="fa fa-wheelchair"></i></a>
      </div>

      <div class="collapse navbar-collapse" id="special-slide-menu">
        <ul class="nav navbar-nav">
          <li><p class="navbar-text"><?= Yii::t('frontend', 'Color') ?>:</p></li>
          <li class="sp-contrast"><a href="#" id="spec_contrast_0" spec-number="0" class="active"><?= Yii::t('frontend', 'Normal') ?></a></li>
          <li class="sp-contrast"><a href="#" id="spec_contrast_1" spec-number="1"><?= Yii::t('frontend', 'Black') ?></a></li>
          <li class="sp-contrast"><a href="#" id="spec_contrast_2" spec-number="2"><?= Yii::t('frontend', 'White') ?></a></li>
          <li class="sp-contrast"><a href="#" id="spec_contrast_3" spec-number="3"><?= Yii::t('frontend', 'Blue') ?></a></li>
          <li class="sp-contrast"><a href="#" id="spec_contrast_4" spec-number="4"><?= Yii::t('frontend', 'Brown') ?></a></li>
          <li><p class="navbar-text"><?= Yii::t('frontend', 'Font') ?>:</p></li>
          <li class="sp-font"><a href="#" id="spec_font_0" class="active" spec-number="0"><?= Yii::t('frontend', 'Normal') ?></a></li>
          <li class="sp-font"><a href="#" id="spec_font_1" spec-number="1"><?= Yii::t('frontend', 'Average') ?></a></li>
          <li class="sp-font"><a href="#" id="spec_font_2" spec-number="2"><?= Yii::t('frontend', 'Big') ?></a></li>
          <li><p class="navbar-text"><?= Yii::t('frontend', 'Images') ?>:</p></li>
          <li class="sp-img"><a href="#" id="spec_image_0" class="active"><?= Yii::t('frontend', 'Hide') ?></a></li>
        </ul>
      </div>
    </div>
  </nav>
</div>