<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Language */

$this->title = Yii::t('backend', 'Create Language');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Languages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="language-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
