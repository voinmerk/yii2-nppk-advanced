<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\widgets\Pjax;
use yii\widgets\Menu;

use frontend\widgets\Alert;
use frontend\assets\AppAsset;

AppAsset::register($this);

$request = new Yii::$app->request();

if($request->get('r')) {}

$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => '/img/icon.ico']);
?>
<?php $this->beginPage() ?>
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
           <div class="spn_hol">
                <div class="spinner">
                    <div class="logo-loader"></div>
                    <div class="bnc bounce1"></div>
                    <div class="bnc bounce2"></div>
                    <div class="bnc bounce3"></div>
                </div>
            </div>

            <!-- HEADER -->
            <header id="header" class="fixed">
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
                                ['label' => Yii::t('frontend', 'Information'), 'url' => ['blog/index', 'id' => 'news']],
                                ['label' => Yii::t('frontend', 'Timetable'), 'url' => ['site/timetable']],
                                ['label' => Yii::t('frontend', 'Rooms'), 'url' => ['site/rooms']],
                                ['label' => Yii::t('frontend', 'Employees'), 'url' => ['site/teachers']],
                              ],
                              'activeCssClass' => 'active',
                          ]); ?>

                          <ul class="nav navbar-nav wow fadeInLeftBig animated" data-wow-duration=".5s" data-wow-delay=".25s">
                            <li><a href="<?= Url::to('//nppk54.ru') ?>"><i class="fa fa-globe"></i> <?= Yii::t('frontend', 'Our website') ?></a></li>
                          </ul>

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
            </header>
            <!-- END HEADER -->

            <div id="content">
                <div class="container">

                    <!-- <?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
                    <?= Alert::widget() ?>  -->

                    <?= $content ?>

                </div>
            </div>

            <footer id="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <ul class="nav">
                                <li><a href="<?= Url::to(['site/index']) ?>"><?= Yii::t('frontend', 'Home') ?></a></li>
                                <li><a href="<?= Url::toRoute(['blog/index', 'id' => 'news']) ?>"><?= Yii::t('frontend', 'Information') ?></a></li>
                                <li><a href="<?= Url::to(['site/timetable']) ?>"><?= Yii::t('frontend', 'Timetable') ?></a></li>
                                <li><a href="<?= Url::to(['site/rooms']) ?>"><?= Yii::t('frontend', 'Rooms') ?></a></li>
                                <li><a href="<?= Url::to(['site/teachers']) ?>"><?= Yii::t('frontend', 'Teachers') ?></a></li>
                                <li><a href="<?= Url::to('//nppk54.ru') ?>" title="nppk54.ru"><?= Yii::t('frontend', 'Our website') ?></a></li>
                            </ul>
                        </div>

                        <hr class="hidden-sm hidden-md hidden-lg">

                        <div class="col-sm-6 col-md-6">
                            <?= $this->render('main/footer-menu') ?>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-xs-4 col-sm-3 col-md-5">
                            <p class="text-left"><?= Yii::t('frontend', 'NPPK') ?> &copy; 2017</p>
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
        </div>
        <script type="text/javascript">
            var lang_show = '<?= Yii::t('frontend', 'Show') ?>';
            var lang_hide = '<?= Yii::t('frontend', 'Hide') ?>';
        </script>
        <?php $this->endBody() ?>
        <script type="text/javascript">
            $('#home-banner > .flexslider').flexslider({
                animation: "fade",
                controlNav: false,
                directionNav: false,
                multipleKeyboard: true,
            });

            $(document).ready(function() {
                $('.thumbnails').magnificPopup({
                    delegate: 'a.thumbnail',
                    type: 'image',
                    removalDelay: 500,
                    callbacks: {
                        beforeOpen: function() {
                            this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
                            this.st.mainClass = this.st.el.attr('data-effect');
                        }
                    },
                    closeOnContentClick: true,
                    midClick: true
                });

                $('.ajax-popup').magnificPopup({
                    type: 'ajax',
                    alignTop: true,
                    overflowY: 'scroll',
                    fixedContentPos: true,
                    fixedBgPos: true,
                    closeBtnInside: true,
                    preloader: true,
                    removalDelay: 500,
                    callbacks: {
                        beforeOpen: function() {
                            this.st.mainClass = this.st.el.attr('data-effect');
                        }
                    },
                    midClick: true
                });

                $('.slider-for').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    fade: true,
                    asNavFor: '.slider-nav'
                });

                $('.slider-nav').slick({
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    asNavFor: '.slider-for',
                    dots: true,
                    centerMode: true,
                    focusOnSelect: true
                });

                $('.panel-body.thumbnails > span.cut').css({'display' : 'none'});

                $('a.btn-read-more.dop').click(function(){
                    var id = $(this).attr('js-id');

                    $(id+'.panel-body.thumbnails > span.cut').slideToggle('normal');
                });
            });

            function playSound() {
                var sound = new buzz.sound("/web/sounds/sound", {
                    formats: [ "wav" ]
                });

                sound.play();

                return false;
            }
        </script>
    </body>
</html>
<?php $this->endPage() ?>
