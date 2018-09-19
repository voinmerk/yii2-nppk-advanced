<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Group */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Group',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="group-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
