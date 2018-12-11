<?php

use yii\helpers\Html;
use yii\helpers\Url;
// use yii\widgets\Menu;
use valiant\widgets\ListGroupWidget as Menu;

$request = Yii::$app->request;

$menuItems = [];

$menuItems[] = [
    'label' => 'Новости',
    'url' => Url::to(['blog/index']),
    'options' => ['class' => 'list-group-item'],
];

if($categories) {
    foreach($categories as $category) {
        $menuItems[] = [
            'label' => $category->title,

            'url' => Url::to(['blog/view', 'category' => $category->slug]),
            'options' => ['class' => 'list-group-item'],
            'active' => isset($request->get['post']) && $request->get['post'] == $category->post->slug,
        ];
    }

    echo Menu::widget([
        'items' => $menuItems,
        'options' => ['class' => 'list-group'],
        //'active' => true,
    ]);
} else { ?>
<div class="alert alert-warning">
    <p><?= Yii::t('frontend', 'The list of categories is not filled!') ?></p>
</div>
<?php } ?>
