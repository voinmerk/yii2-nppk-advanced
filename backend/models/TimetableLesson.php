<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%timetables_lesson}}".
 *
 * @property int $id
 * @property int $timetable_id
 * @property int $lesson_id
 * @property int $room_id
 * @property int $sort_order
 *
 * @property Lessons $lesson
 * @property Rooms $room
 * @property Timetables $timetable
 */
class TimetableLesson extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%timetables_lesson}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['timetable_id', 'lesson_id', 'room_id'], 'required'],
            [['timetable_id', 'lesson_id', 'room_id', 'sort_order'], 'integer'],
            [['lesson_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lesson::className(), 'targetAttribute' => ['lesson_id' => 'id']],
            [['room_id'], 'exist', 'skipOnError' => true, 'targetClass' => Room::className(), 'targetAttribute' => ['room_id' => 'id']],
            [['timetable_id'], 'exist', 'skipOnError' => true, 'targetClass' => Timetable::className(), 'targetAttribute' => ['timetable_id' => 'id']],
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
            'lesson_id' => Yii::t('backend', 'Lesson ID'),
            'room_id' => Yii::t('backend', 'Room ID'),
            'sort_order' => Yii::t('backend', 'Sort Order'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLesson()
    {
        return $this->hasOne(Lesson::className(), ['id' => 'lesson_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(Room::className(), ['id' => 'room_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTimetable()
    {
        return $this->hasOne(Timetable::className(), ['id' => 'timetable_id']);
    }
}
