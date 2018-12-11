<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use rmrevin\yii\fontawesome\FA;
use dosamigos\datetimepicker\DateTimePicker;
use backend\models\Teacher;
use backend\models\Room;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TeacherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Employees');;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-index box box-primary">

    <?= $this->render('@viewComponents/_header_index_tools') ?>

    <div class="box-body table-responsive no-padding">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'title',
                //'content:ntext',
                [
                    'attribute' => 'room_id',
                    'format' => 'html',
                    'value' => function($model) {
                        return $model->room_id ? Html::a($model->roomName, ['room/view', 'id' => $model->room_id], ['class' => 'btn btn-default btn-flat', 'style' => 'width: 100%;']) : null;
                    },
                    'filter' => ArrayHelper::map(Room::find()->select(['id', 'title'])->asArray()->all(), 'id', 'title'),
                ],
                [
                    'attribute' => 'createdName',
                    'format' => 'html',
                    'value' => function($model) {
                        return Html::a($model->createdName, ['user/view', 'id' => $model->created_by], ['class' => 'btn btn-link btn-flat', 'style' => 'width: 100%;']);
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
                    'filter' => Teacher::getStatusList(),
                ],
                // 'sort_order',
                // 'teacher_group_id',
                // 'image_id',
                // 'created_by',
                // 'updated_by',
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
                            return Html::a(FA::icon('trash-o'), $url, ['class' => 'btn btn-danger btn-flat']);
                        },
                    ],
                    'headerOptions' => ['class' => 'text-right'],
                    'contentOptions' => ['class' => 'text-right'],
                ],
            ],
        ]); ?>
    </div>
</div>
