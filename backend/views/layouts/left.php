<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$isActive = function($controller, $action, $onlyController = false) {
    if($onlyController) {
        return Yii::$app->controller->id == $controller;
    }

    return Yii::$app->controller->id == $controller && Yii::$app->controller->action->id == $action;
};

$menuItems = [
    // Main menu
    ['label' => 'Меню', 'options' => ['class' => 'header']],
    ['label' => 'Панель состояния', 'icon' => 'tachometer', 'url' => ['/site/index'], 'active' => $isActive('site', 'index', true)],
    [
        'label' => 'Контент',
        'icon' => 'newspaper-o',
        'url' => '#',
        'items' => [
            ['label' => 'Записи', 'icon' => 'circle-o', 'url' => ['/post/index'], 'active' => $isActive('post', '', true)],
            ['label' => 'Категории', 'icon' => 'circle-o', 'url' => ['/category/index'], 'active' => $isActive('category', '', true)],
            ['label' => 'Новости', 'icon' => 'circle-o', 'url' => ['/news/index'], 'active' => $isActive('news', '', true)],
            ['label' => 'Кабинеты', 'icon' => 'circle-o', 'url' => ['/room/index'], 'active' => $isActive('room', '', true)],
        ],
    ],
    [
        'label' => 'Расписание',
        'icon' => 'th',
        'url' => '#',
        'items' => [
            ['label' => 'Группы', 'icon' => 'circle-o', 'url' => ['/group/index'], 'active' => $isActive('group', '', true)],
            ['label' => 'Предметы', 'icon' => 'circle-o', 'url' => ['/lesson/index'], 'active' => $isActive('lesson', '', true)],
            ['label' => 'Расписание', 'icon' => 'circle-o', 'url' => ['/timetable/index'], 'active' => $isActive('timetable', '', true)],
        ],
    ],
    [
        'label' => 'Мультимедиа',
        'icon' => 'picture-o',
        'url' => '#',
        'items' => [
            ['label' => 'Баннеры', 'icon' => 'circle-o', 'url' => ['/banner/index'], 'active' => $isActive('banner', '', true)],
            ['label' => 'Изображения', 'icon' => 'circle-o', 'url' => ['/image/index'], 'active' => $isActive('image', '', true)],
        ],
    ],
    [
        'label' => 'Сотрудники',
        'icon' => 'user',
        'url' => '#',
        'items' => [
            ['label' => 'Сотрудники', 'icon' => 'circle-o', 'url' => ['/teacher/index'], 'active' => $isActive('teacher', '', true)],
            ['label' => 'Группы', 'icon' => 'circle-o', 'url' => ['/teacher-group/index'], 'active' => $isActive('teacher-group', '', true)],
        ],
    ],
    [
        'label' => 'Пользователи',
        'icon' => 'users',
        'url' => '#',
        'items' => [
            ['label' => 'Пользователи', 'icon' => 'circle-o', 'url' => ['/user/index'], 'active' => $isActive('user', '', true)],
            ['label' => 'Группы', 'icon' => 'circle-o', 'url' => ['/user-group/index'], 'active' => $isActive('user-group', '', true)],
            //['label' => 'Роли', 'icon' => 'circle-o', 'url' => ['/user-permission']],
        ],
    ],

    // Development
    ['label' => 'Разработка', 'options' => ['class' => 'header']],
    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
];

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

        <?= dmstr\widgets\Menu::widget([
            'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
            'items' => $menuItems
        ]); ?>

    </section>

</aside>
