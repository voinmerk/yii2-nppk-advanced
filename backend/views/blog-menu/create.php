<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Blog */

$this->title = Yii::t('backend', 'Create Blog');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Blogs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
