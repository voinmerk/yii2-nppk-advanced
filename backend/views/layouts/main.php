<?php
use yii\helpers\Html;
use yii\helpers\Url;

$user = \common\models\User::findOne(Yii::$app->user->identity->getId());

if (class_exists('backend\assets\AppAsset')) {
    backend\assets\AppAsset::register($this);
} else {
    app\assets\AppAsset::register($this);
}

dmstr\web\AdminLteAsset::register($this);

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => '/img/icon.ico']);

$js = <<<JS
/* To initialize BS3 tooltips set this below */
$(function () { 
    $("[data-toggle='tooltip']").tooltip(); 
});;
/* To initialize BS3 popovers set this below */
$(function () { 
    $("[data-toggle='popover']").popover(); 
});
JS;
// Register tooltip/popover initialization javascript
$this->registerJs($js);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition sidebar-mini <?= \dmstr\helpers\AdminLteHelper::skinClass() ?>">
<?php $this->beginBody() ?>
<div class="wrapper">

    <?= $this->render(
        'header.php',
        ['directoryAsset' => $directoryAsset, 'user' => $user]
    ) ?>

    <?= $this->render(
        'left.php',
        ['directoryAsset' => $directoryAsset, 'user' => $user]
    )
    ?>

    <?= $this->render(
        'content.php',
        ['content' => $content, 'directoryAsset' => $directoryAsset, 'user' => $user]
    ) ?>

</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>