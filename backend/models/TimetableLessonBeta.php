<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "timetable_lesson_beta".
 *
 * @property int $id
 * @property int $timetable_id
 * @property int $sort_order
 * @property string $lesson
 * @property string $room
 *
 * @property Timetable $timetable
 */
class TimetableLessonBeta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'timetable_lesson_beta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['timetable_id'], 'required'],
            //[['timetable_id', 'sort_order'], 'integer'],
            [['lesson', 'room'], 'string', 'max' => 255],
            //[['timetable_id'], 'exist', 'skipOnError' => true, 'targetClass' => Timetable::className(), 'targetAttribute' => ['timetable_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'timetable_id' => Yii::t('backend', 'Timetable ID'),
            'sort_order' => Yii::t('backend', 'Sort Order'),
            'lesson' => Yii::t('backend', 'Lesson'),
            'room' => Yii::t('backend', 'Room'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTimetable()
    {
        return $this->hasOne(Timetable::className(), ['id' => 'timetable_id']);
    }
}
