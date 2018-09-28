<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Blog */

$this->title = 'Создать статью';
$this->params['breadcrumbs'][] = ['label' => 'Блог', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-create">

    <?= $this->render('_form', [
	    'blog' => $blog,
        'blogMenuItem' => $blogMenuItem,
        'languages' => $languages,
    ]) ?>

</div>
