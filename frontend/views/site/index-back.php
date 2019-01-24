<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

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

$this->registerCss($css);

$this->title = 'НППК - ' . Yii::t('frontend', 'Home');
?>

  <section id="home" class="slider">
    <?php if($banner->images) { ?>
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        
        <?php foreach($banner->images as $index => $image) { ?>
        <li data-target="#carousel-example-generic" data-slide-to="<?= $index ?>" class="<?= (!$index ? 'active' : '') ?>"></li>
        <?php } ?>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        <?php foreach($banner->images as $index => $image) { ?>
        <div class="item <?= (!$index ? 'active' : '') ?>">
          <?= Html::img('@web' . $image->src) ?>

          <div class="carousel-caption">
            Lorem ipsum
          </div>
        </div>
        <?php } ?>
      </div>

      <!-- Controls -->
      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    <?php } ?>
  </section>