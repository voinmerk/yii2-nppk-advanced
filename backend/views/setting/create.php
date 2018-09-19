<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Setting */

$this->title = Yii::t('backend', 'Create Setting');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
