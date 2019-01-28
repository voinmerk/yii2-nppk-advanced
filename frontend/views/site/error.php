<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <div class="container">
        <div class="page-header">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>

        <div class="page-body">
            <div class="alert alert-danger">
                <?= nl2br(Html::encode($message)) ?>
            </div>

            <br>

            <p>
                <?= Yii::t('common', 'The above error occurred while the Web server was processing your request.') ?>
            </p>
            <p>
                <?= Yii::t('common', 'Please contact us if you think this is a server error. Thank you.') ?>
            </p>
        </div>
    </div>

</div>
