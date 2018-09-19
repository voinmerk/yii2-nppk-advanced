<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TeacherGroup */

$this->title = Yii::t('backend', 'Create Teacher Group');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Teacher Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-group-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
