<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Room */

$this->title = Yii::t('backend', 'Create Room');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Rooms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
