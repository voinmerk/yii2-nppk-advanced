<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\StringHelper;

$css = <<<css
body {
  background-color: #fff;
  background-image: none;
}

#content {
  padding: 72px 0 0 0;
}

@media (max-width: 1090px) {
  #content {
    padding: 66.85px 0 0 0;
  }
}

@media (max-width: 991px) {
  #content {
    padding: 50px 0 0 0;
  }
}
css;

if($banner->images) {
  foreach($banner->images as $image) {
    $css .= '
      .banner-i'.$image->id.' {
        background-image: url(..'.$image->src.');
      }
    ';
  }
}

$this->registerCss($css);

$js = <<<JS
$(function() {
  $('.feature-content').jScrollPane();
});
JS;

$this->registerJs($js);

$this->title = 'НППК - ' . Yii::t('frontend', 'Home');
?>
<div class="site-index">
  <?php if($banner->images) { ?>
  <section id="home-banner" class="slider">
    <div class="flexslider">
      <ul class="slides">
        <?php foreach($banner->images as $image) { ?>
        <li>
          <div class="banner-image banner-i<?= $image->id ?>"></div>

          <div class="banner-caption">
            <p><?= $image->title ?></p>

            <a href="tel:+79999999999" class="btn btn-primary btn-lg"><i class="fa fa-phone"></i> +7 (999) 999 99-99</a>
          </div>
        </li>
        <?php } ?>
      </ul>
    </div>
  </section>
  <?php } ?>

  <section id="feature">
    <div class="container">
      <div class="page-header">
        <h2>Рубрики</h2>
      </div>

      <div class="row">
        <?php if ($categories) { ?>
        <?php foreach ($categories as $category) { ?>
        <div class="col-md-3 col-sm-6">
          <div class="feature-card">
            <h4 class="feature-title"><?= StringHelper::truncate(Html::encode($category->title), 13) ?></h4>
            
            <p class="feature-content"><?= StringHelper::truncate(Html::encode($category->description), 180) ?></p>

            <?= Html::a('Читать...', ['/post/category', 'category' => $category->slug], ['class' => 'feature-btn']) ?>
          </div>
        </div>
        <?php } ?>
        <?php } ?>
      </div>
    </div>
  </section>
</div>