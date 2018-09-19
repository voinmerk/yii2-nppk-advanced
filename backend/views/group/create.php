<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Group */

$this->title = Yii::t('backend', 'Create Group');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
