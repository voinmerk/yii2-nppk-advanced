<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\LanguagePhrase */

$this->title = Yii::t('backend', 'Create Language Phrase');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Language Phrases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="language-phrase-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
