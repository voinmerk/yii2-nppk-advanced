<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Blog */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Blogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-view box box-primary">
    <div class="box-header">
        <?= $this->render('@viewComponents/header-view', [
            'title' => $model->name,
            'action_update' => Url::to(['blog/update', 'id' => $model->id]),
            'action_delete' => Url::to(['blog/delete', 'id' => $model->id]),
        ]) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                // 'id',
                'name:text',
                [
                    'attribute' => 'fixed',
                    'format' => 'html',
                    'value' => function($model) {
                        $name = $model->fixed ? 'Да' : 'Нет';

                        return '<span class="label label-default">' . $name . '</span>';
                    },
                ],
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
                [
                    'attribute' => 'cut',
                    'format' => 'html',
                    'value' => function($model) {
                        $name = $model->cut ? 'Есть' : 'Нет';

                        return '<span class="label label-default">' . $name . '</span>';
                    },
                ],
                'createdName',
                'updatedName',
                'blogMenuName',
                'created_at:datetime',
                'updated_at:datetime',
            ],
        ]) ?>
    </div>
</div>
