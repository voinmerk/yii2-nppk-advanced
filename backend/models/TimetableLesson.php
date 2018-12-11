<?php

namespace backend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "{{%timetable_lesson}}".
 *
 * @property int $id
 * @property int $timetable_id
 * @property int $lesson_id
 * @property int $room_id
 * @property int $sort_order
 *
 * @property Lesson $lesson
 * @property Room $room
 * @property Timetable $timetable
 */
class TimetableLesson extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%timetable_lesson}}';
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
            'timetable_id' => 'Timetable ID',
            'lesson_id' => 'Lesson ID',
            'room_id' => 'Room ID',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLessons()
    {
        return Lesson::find()->where(['published' => Lesson::PUBLISHED])->all();
    }

    /**
     * {@inheritdoc}
     */
    public static function getLessonList()
    {
        $lessonList = \yii\helpers\ArrayHelper::map(self::getLessons(), 'id', 'name');

        return $lessonList;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRooms()
    {
        return Room::find()->where(['published' => Room::PUBLISHED])->all();
    }

    /**
     * {@inheritdoc}
     */
    public static function getRoomList()
    {
        $roomList = \yii\helpers\ArrayHelper::map(self::getRooms(), 'id', 'title');

        return $roomList;
    }
}
