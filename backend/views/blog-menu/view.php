<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Blog */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Blogs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-view box box-primary">
    <div class="box-header">
        <?= $this->render('@viewComponents/header-view', [
            'title' => $model->name,
            'action_update' => Url::to(['blog-menu/update', 'id' => $model->id]),
            'action_delete' => Url::to(['blog-menu/delete', 'id' => $model->id]),
        ]) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                // 'id',
                'name:text',
                'slug',
                [
                    'attribute' => 'template',
                    'format' => 'html',
                    'value' => function($model) {
                        return '<span class="label label-warning">' . $model->templateName . '</span>';
                    },
                ],
                [
                    'attribute' => 'published',
                    'format' => 'html',
                    'value' => function($model) {
                        $class = $model->published ? ' label-success' : ' label-danger';
                        $name = $model->statusName;

                        return '<span class="label' . $class . '">' . $name . '</span>';
                    },
                    'filter' => \backend\models\Blog::getStatusList(),
                ],
                'createdName',
                'updatedName',
                'created_at:datetime',
                'updated_at:datetime',
            ],
        ]) ?>
    </div>
</div>
