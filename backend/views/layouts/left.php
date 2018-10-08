<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$menuItems = [
    // Main menu
    ['label' => 'Меню', 'options' => ['class' => 'header']],
    ['label' => 'Панель состояния', 'icon' => 'tachometer', 'url' => ['/site/index']],
    [
        'label' => 'Блог',
        'icon' => 'newspaper-o',
        'url' => '#',
        'items' => [
            ['label' => 'Статьи', 'icon' => 'circle-o', 'url' => ['/blog']],
            ['label' => 'Навигация', 'icon' => 'circle-o', 'url' => ['/blog-menu']],
        ],
    ],
    [
        'label' => 'Расписание',
        'icon' => 'th',
        'url' => '#',
        'items' => [
            ['label' => 'Группы', 'icon' => 'circle-o', 'url' => ['/group']],
            ['label' => 'Предметы', 'icon' => 'circle-o', 'url' => ['/lesson']],
            ['label' => 'Расписание', 'icon' => 'circle-o', 'url' => ['/timetable']],
        ],
    ],
    [
        'label' => 'Мультимедиа',
        'icon' => 'picture-o',
        'url' => '#',
        'items' => [
            ['label' => 'Изображения', 'icon' => 'circle-o', 'url' => ['/image']],
        ],
    ],
    [
        'label' => 'Сотрудники',
        'icon' => 'address-card-o',
        'url' => '#',
        'items' => [
            ['label' => 'Сотрудники', 'icon' => 'circle-o', 'url' => ['/teacher']],
            ['label' => 'Группы', 'icon' => 'circle-o', 'url' => ['/teacher-group']],
        ],
    ],
    [
        'label' => 'Пользователи',
        'icon' => 'users',
        'url' => '#',
        'items' => [
            ['label' => 'Пользователи', 'icon' => 'circle-o', 'url' => ['/user']],
            ['label' => 'Группы', 'icon' => 'circle-o', 'url' => ['/user-group']],
            ['label' => 'Роли', 'icon' => 'circle-o', 'url' => ['/user-permission']],
        ],
    ],
    [
        'label' => 'Локализация',
        'icon' => 'globe',
        'url' => '#',
        'items' => [
            ['label' => 'Языки', 'icon' => 'circle-o', 'url' => ['/language']],
            ['label' => 'Переводы', 'icon' => 'circle-o', 'url' => ['/language-phrase']],
        ],
    ],

    // Development
    ['label' => 'Разработка', 'options' => ['class' => 'header']],
    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
    /*['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
    [
        'label' => 'Some tools',
        'icon' => 'share',
        'url' => '#',
        'items' => [
            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
            [
                'label' => 'Level One',
                'icon' => 'circle-o',
                'url' => '#',
                'items' => [
                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                    [
                        'label' => 'Level Two',
                        'icon' => 'circle-o',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                        ],
                    ],
                ],
            ],
        ],
    ],*/
];

$model = new \backend\models\forms\SearchForm;

?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= $user->username ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> В сети</a>
            </div>
        </div>

        <!-- search form -->
        <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Искать..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form> -->
        <?php $form = ActiveForm::begin(['id' => 'form-search', 'options' => ['class' => 'sidebar-form']]); ?>

        <?= $form->field($model, 'q', [
            'inputTemplate' => '<div class="input-group">{input}<span class="input-group-btn"><button class="btn btn-flat" type="submit"><i class="fa fa-search"></i></button></span></div>'
        ])->textInput([
            'placeholder' => Yii::t('backend', 'Search...')
        ])->label(false) ?>

        <?php ActiveForm::end(); ?>

        <?= $this->blocks['search'] ?>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget([
            'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
            'items' => $menuItems
        ]); ?>

    </section>

</aside>
