<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use rmrevin\yii\fontawesome\FA;
use dosamigos\datetimepicker\DateTimePicker;

$this->title = Yii::t('backend', 'News');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index box box-primary">
    <?php Pjax::begin(); ?>

    <?= $this->render('@viewComponents/_header_index_tools') ?>

    <div class="box-body table-responsive no-padding">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{pager}",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'title',
                [
                    'attribute' => 'createdName',
                    'format' => 'html',
                    'value' => function($model) {
                        return Html::a($model->createdName, ['/user/view', 'id' => $model->created_by], ['class' => 'btn btn-link btn-flat btn-block']);
                    },
                    'filter' => $searchModel->getCreatedName(),
                ],
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
