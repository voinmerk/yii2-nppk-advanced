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

if($banner->bannerCaptions) {
  foreach($banner->bannerCaptions as $bannerCaption) {
    $css .= '
      .banner-i'.$bannerCaption->id.' {
        background-image: url(..'.$bannerCaption->image->src.');
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
  <?php if($banner->bannerCaptions) { ?>
  <section id="home-banner" class="slider">
    <div class="flexslider">
      <ul class="slides">
        <?php foreach($banner->bannerCaptions as $bannerCaption) { ?>
        <li>
          <div class="banner-image banner-i<?= $bannerCaption->id ?>"></div>

          <div class="banner-caption">
            <p><?= $bannerCaption->title ?></p>

            <?php if ($bannerCaption->btn_status) { ?>
            <a href="<?= $bannerCaption->btn_link ?>" class="btn btn-primary btn-lg"><?= Html::decode($bannerCaption->btn_caption) ?></a>
            <?php } ?>
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