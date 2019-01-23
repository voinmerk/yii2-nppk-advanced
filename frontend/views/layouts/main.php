<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

use frontend\assets\AppAsset;
use frontend\widgets\Alert;

AppAsset::register($this);

$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => '/img/icon.ico']);

$this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <div class="wrapper">
            <!-- preloader animation -->
            <?= $this->render('_preloader') ?>
            <!-- end preloader animation -->

            <!-- header -->
            <header id="header" class="fixed">
                <?= $this->render('_special_tools') ?>

                <?= $this->render('_header') ?>
            </header>
            <!-- end header -->

            <!-- content -->
            <?= $this->render('_content', [
                'content' => $content
            ]) ?>
            <!-- end content -->
        </div>

        <!-- footer -->
        <?= $this->render('_footer') ?>
        <!-- end footer -->

        <script type="text/javascript">
            var lang_show = '<?= Yii::t('frontend', 'Show') ?>';
            var lang_hide = '<?= Yii::t('frontend', 'Hide') ?>';
        </script>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
