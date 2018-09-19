<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Lesson */

$this->title = Yii::t('backend', 'Create Lesson');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Lessons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lesson-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
