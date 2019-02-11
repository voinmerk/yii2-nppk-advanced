<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Teacher */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Teachers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-view box box-primary">
    
    <?= $this->render('@viewComponents/_header_view_tools', [
        'id' => $model->id,
    ]) ?>

    <div class="box-body table-responsive no-padding">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                // 'id',
                'title',
                // 'content:ntext',
                'teacherGroupName',
                'roomName',
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
                // 'image_id',
                'createdName',
                'updatedName',
                'created_at:datetime',
                'updated_at:datetime',
            ],
        ]) ?>
    </div>
</div>
