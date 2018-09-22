<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Blog */

$this->title = 'Update Blog: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Blogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="blog-update">

    <?= $this->render('_form', [
        'model' => $model,
    	'blogMenuItem' => $blogMenuItem
    ]) ?>

</div>
