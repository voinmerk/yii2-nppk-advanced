<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Teacher */

$this->title = Yii::t('backend', 'Create Teacher');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Teachers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
