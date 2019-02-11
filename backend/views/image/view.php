<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Image */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-view box box-primary">
    
    <?= $this->render('@viewComponents/_header_view_tools', [
        'id' => $model->id,
    ]) ?>

    <div class="box-body table-responsive no-padding">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                // 'id',
                // 'title',
                // 'content:ntext',
                [
                    'attribute' => 'src',
                    'format' => 'html',
                    'value' => function($model) {
                        return Html::img($model->src, ['style' => 'max-width: 150px;']);
                    },
                ],
                'createdName',
                'updatedName',
                'created_at:datetime',
                'updated_at:datetime',
            ],
        ]) ?>
    </div>
</div>
