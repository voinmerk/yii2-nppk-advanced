<?php

use yii\helpers\Html;
use yii\helpers\Url;
// use yii\widgets\Menu;
use valiant\widgets\ListGroupWidget;

$request = Yii::$app->request;

$menuItems = [];

if($categories) {
    foreach($categories as $category) {
        $menuItems[] = [
            'label' => $category->title,
            'url' => Url::to(['blog/category', 'category' => $category->slug]),
            'active' => isset($request->get['category']) && $request->get['category'] == $category->slug,
        ];
    }

    echo ListGroupWidget::widget([
        'items' => $menuItems,
        //'active' => true,
    ]);
} else { ?>
<div class="alert alert-warning">
    <p><?= Yii::t('frontend', 'The list of categories is not filled!') ?></p>
</div>
<?php } ?>