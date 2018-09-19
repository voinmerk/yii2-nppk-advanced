<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'НППК - ' . Yii::t('frontend', 'Home');
?>

<section id="home-banner" class="slider">
    <div class="flexslider">
        <ul class="slides">
            <?php foreach($banners as $banner) { ?>
            <li>
                <?= Html::img('@web' . $banner['image']['src'], [
                    'title' => $banner['image']['name'],
                    'alt' => $banner['image']['description']
                ]) ?>
            </li>
            <?php } ?>
        </ul>
    </div>
</section>

<style type="text/css">
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
</style>