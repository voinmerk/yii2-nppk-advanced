<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\LanguagePhrase */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Language Phrase',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Language Phrases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="language-phrase-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
