<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Timetable */

$this->title = 'Create Timetable';
$this->params['breadcrumbs'][] = ['label' => 'Timetables', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timetable-create">

    <?= $this->render('_form', [
    	'model' => $model,
    	'modelLessons' => $modelLessons,
    ]) ?>

</div>
