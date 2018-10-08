<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use dosamigos\datetimepicker\DateTimePicker;
use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TimetableSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Timetables');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timetable-index box box-primary">
    <div class="box-header with-border">
        <?= $this->render('@viewComponents/header-list', [
            'title' => Yii::t('backend', 'Timetables list'),
            'action_create' => Url::to(['create']),
            'action_copy' => Url::to(['copy-rows']),
            'action_delete' => Url::to(['delete-rows']),
        ]) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'class' => 'yii\grid\CheckboxColumn',
                    'name' => 'id',
                    'checkboxOptions' => function($model) {
                        return [
                            'onchange' => '
                               var keys = $("#grid").yiiGridView("getSelectedRows");
                               $(this).parent().parent().toggleClass("danger")
                            ',
                            'value' => $model->id,
                        ];
                    }
                ],
                'groupName:text',
                'createdName:text',
                [
                    'attribute' => 'date',
                    'format' => 'date',
                    'filter' => DateTimePicker::widget([
                        'model' => $searchModel,
                        'value' => $searchModel->date,
                        'attribute' => 'date',
                        'language' => 'ru',
                        'size' => 'ms',
                        'clientOptions' => [
                            'autoclose' => true,
                            'format' => 'dd MM yyyy',
                            'todayBtn' => true
                        ]
                    ]),
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
                    'template' => '{view} {update}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a(Fa::icon('eye'), $url, ['class' => 'btn btn-primary btn-flat']);
                        },
                        'update' => function ($url, $model) {
                            return Html::a(Fa::icon('pencil'), $url, ['class' => 'btn btn-warning btn-flat']);
                        },
                    ],
                    'headerOptions' => ['class' => 'text-right'],
                    'contentOptions' => ['class' => 'text-right'],
                ],
            ],
        ]); ?>
    </div>
</div>
