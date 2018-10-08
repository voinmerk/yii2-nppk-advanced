<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Timetable */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Timetable',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Timetables'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="timetable-update">

    <?= $this->render('_form', [
    	'lessonList' => $lessonList,
        'roomList' => $roomList,
        'groupList' => $groupList,
        'model' => $model,
    ]) ?>

</div>
