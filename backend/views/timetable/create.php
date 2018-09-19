<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Timetable */

$this->title = Yii::t('backend', 'Create Timetable');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Timetables'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timetable-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
