<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use rmrevin\yii\fontawesome\FA;
use dosamigos\datetimepicker\DateTimePicker;

$this->title = Yii::t('backend', 'Images');;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-index box box-primary">
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
                'content:ntext',
                [
                    'attribute' => 'src',
                    'format' => 'html',
                    'value' => function($model) {
                        return Html::img($model->src, ['class' => 'img-responsive', 'style' => 'max-height: 100px;margin: 0 auto;']);
                    },
                ],
                [
                    'attribute' => 'createdName',
                    'format' => 'html',
                    'value' => function($model) {
                        return Html::a($model->createdName, ['/user/view', 'id' => $model->created_by], ['class' => 'btn btn-link btn-flat btn-block']);
                    },
                    'filter' => $searchModel->getCreatedName(),
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
                            return Html::a(FA::icon('trash-o'), $url, ['class' => 'btn btn-danger btn-flat']);
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
