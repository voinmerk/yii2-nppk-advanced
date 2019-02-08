<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use rmrevin\yii\fontawesome\FA;
use dosamigos\datetimepicker\DateTimePicker;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index box box-primary">
    <?php Pjax::begin(); ?>
    <div class="box-header with-border">
        <?= Html::a(Yii::t('backend', 'Create Post'), ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                // 'id',
                'title',
                // 'content:ntext',
                // 'meta_title',
                // 'meta_keywords:ntext',
                // 'meta_description:ntext',
                // 'slug',
                'categoryName',
                'createdName',
                [
                    'attribute' => 'status',
                    'format' => 'html',
                    'value' => function($model) {
                        $class = $model->status ? ' label-success' : ' label-danger';
                        $name = $model->statusName;

                        return '<span class="label' . $class . '">' . $name . '</span>';
                    },
                    'filter' => $searchModel->getStatusList(),
                ],
                // 'created_by',
                // 'updated_by',
                // 'updated_by',
                // 'image_id',
                // 'created_at',
                [
                    'attribute' => 'updated_at',
                    'format' => 'datetime',
                    'filter' => DateTimePicker::widget([
                        'model' => $searchModel,
                        'value' => $searchModel->updated_at,
                        'attribute' => 'updated_at',
                        'language' => 'ru',
                        'size' => 'ms',
                        'clientOptions' => [
                            'autoclose' => true,
                            'format' => 'dd MM yyyy - HH:ii P',
                            'todayBtn' => true
                        ]
                    ]),
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => Yii::t('backend', 'Actions'),
                    'template' => '{view} {update} {delete}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a(FA::icon('eye'), $url, ['class' => 'btn btn-primary btn-flat']);
                        },
                        'update' => function ($url, $model) {
                            return Html::a(FA::icon('pencil'), $url, ['class' => 'btn btn-warning btn-flat']);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a(FA::icon('trash-o'), $url, [
                                'class' => 'btn btn-danger btn-flat', 
                                'data' => [
                                    'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                                    'method' => 'post',
                                ],
                            ]);
                        },
                    ],
                    'headerOptions' => ['class' => 'text-right'],
                    'contentOptions' => ['class' => 'text-right'],
                ],
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>
