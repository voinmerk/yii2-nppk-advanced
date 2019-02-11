<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use rmrevin\yii\fontawesome\FA;
use dosamigos\datetimepicker\DateTimePicker;

use backend\models\Group;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TimetableSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Timetables');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timetable-index box box-primary">

    <?= $this->render('@viewComponents/_header_index_tools') ?>

    <div class="box-body table-responsive no-padding">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'date:date',
                [
                    'attribute' => 'group_id',
                    'format' => 'html',
                    'value' => function($model) {
                        return Html::a($model->groupName, ['group/view', 'id' => $model->group_id], ['class' => 'btn btn-link btn-flat', 'style' => 'width: 100%;']);
                    },
                    'filter' => ArrayHelper::map(Group::find()->select(['id', 'name'])->asArray()->all(), 'id', 'name'),
                ],
                [
                    'attribute' => 'createdName',
                    'format' => 'html',
                    'value' => function($model) {
                        return Html::a($model->createdName, ['user/view', 'id' => $model->created_by], ['class' => 'btn btn-link btn-flat', 'style' => 'width: 100%;']);
                    },
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
</div>
