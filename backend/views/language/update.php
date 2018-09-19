<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Language */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Language',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Languages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="language-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
