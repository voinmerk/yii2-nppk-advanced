<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Group */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-view box box-primary">
    <div class="box-header">
        <?= $this->render('@viewComponents/header-view', [
            'title' => $model->name,
            'action_update' => Url::to(['group/update', 'id' => $model->id]),
            'action_delete' => Url::to(['group/delete', 'id' => $model->id]),
        ]) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                // 'id',
                'name:text',
                'sort_order',
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
