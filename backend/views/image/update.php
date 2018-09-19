<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Image */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Image',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Images'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="image-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
