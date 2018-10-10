<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TimetableLessonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Timetable Lessons';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timetable-lesson-index box box-primary">
    <div class="box-header with-border">
        <?= Html::a('Create Timetable Lesson', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'timetable_id:datetime',
                'lesson_id',
                'room_id',
                'sort_order',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
