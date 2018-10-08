<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
// use kartik\daterange\DateRangePicker;
use dosamigos\datetimepicker\DateTimePicker;

use rmrevin\yii\fontawesome\FA;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BlogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Блог';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-index box box-primary">
    <div class="box-header with-border">
        <?= $this->render('@viewComponents/header-list', [
            'title' => Yii::t('backend', 'Blog list'),
            'action_create' => Url::to(['blog/create']),
            'action_copy' => Url::to(['blog/copy-rows']),
            'action_delete' => Url::to(['blog/delete-rows']),
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
                'name:text',
                // 'description:html',
                'createdName:text',
                // 'blog_menu_id',
                [
                    // 'label' => Yii::t('backend', 'Status'),
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
                // 'updated_at:datetime',
                /*[
                    'attribute' => 'updated_at',
                    'format' => 'datetime',
                    'filter' => '
                        <div class="drp-container input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>'.
                            DateRangePicker::widget([
                                'name'  => 'ItemOrderSearch[created_at]',
                                'pluginOptions' => [ 
                                    'locale' => [
                                        'separator' => 'to',
                                    ],
                                    'opens' => 'right',
                                ],
                            ]) . '
                        </div>
                    ',
                    'content' => function($data){
                        return Yii::$app->formatter->asDatetime($data['created_at'], "php:d M Y");
                    },
                ],*/
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
