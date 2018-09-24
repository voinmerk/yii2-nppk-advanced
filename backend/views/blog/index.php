<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

use rmrevin\yii\fontawesome\FontAwesome as Fa;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BlogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Блог';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-index box box-primary">
    <div class="box-header with-border">
        <div class="box-title">
            <h3><i class="fa fa-list"></i> Список блогов</h3>
        </div>

        <?= $this->render('@viewComponents/header', [
            'form_id' => 'blog-form',
            'action_create' => Url::to(['blog/create']),
            'action_copy' => Url::to(['blog/copy']),
            'action_delete' => Url::to(['blog/delete']),
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
                    'checkboxOptions' => function() {
                        return [
                            'onchange' => '
                               var keys = $("#grid").yiiGridView("getSelectedRows");
                               $(this).parent().parent().toggleClass("danger")
                            '
                        ];
                    }
                ],
                [
                    'label' => 'Заголовок',
                    'attribute' => 'name',
                    'format' => 'text',
                    'value' => function ($model) {
                        return $model->getFieldName($model->id);
                    },
                ],
                [
                    'label' => 'Статус',
                    'attribute' => 'published',
                    'format' => 'html',
                    'value' => function ($model) {
                        $class = !$model->published ? ' label-success' : ' label-danger';
                        $name = $model->statusName;

                        return '<span class="label' . $class . '">' . $name . '</span>';
                    },
                    'filter' => \backend\models\Blog::getStatusList(),
                ],
                [
                    'label' => 'Автор',
                    'attribute' => 'createdBy.username',
                    // 'format' => 'text',
                    'value' => function ($model) {
                        return $model->createdBy->username;
                    },
                ],
                // 'blog_menu_id',
                'updated_at:datetime',
                [
                    'class' => 'yii\grid\ActionColumn',
                    // 'label' => 'Действие',
                    'template' => '{view} {update}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a(Fa::icon('eye'), $url, ['class' => 'btn btn-primary']);
                        },
                        'update' => function ($url, $model) {
                            return Html::a(Fa::icon('pencil'), $url, ['class' => 'btn btn-warning']);
                        },
                        /*'delete' => function ($url, $model) {
                            return Html::a(Fa::icon('trash-o'), $url, ['class' => 'btn btn-danger']);
                        },*/
                    ],
                ],
            ],
        ]); ?>
    </div>
</div>
