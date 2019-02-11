<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Category */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view box box-primary">
    
    <?= $this->render('@backend/views/components/_header_view_tools', ['id' => $model->id]) ?>

    <div class="box-body table-responsive no-padding">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                // 'id',
                'title',
                // 'description:ntext',
                'slug',
                // 'meta_title',
                // 'meta_description:ntext',
                // 'meta_keywords:ntext',
                [
                    'attribute' => 'status',
                    'format' => 'html',
                    'value' => function($model) {
                        $class = $model->status ? ' label-success' : ' label-danger';
                        $name = $model->statusName;

                        return '<span class="label' . $class . '">' . $name . '</span>';
                    },
                ],
                'sort_order',
                // 'on_home',
                'createdName',
                'updatedName',
                'created_at:datetime',
                'updated_at:datetime',
            ],
        ]) ?>
    </div>
</div>
