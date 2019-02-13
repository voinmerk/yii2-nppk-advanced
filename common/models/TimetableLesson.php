<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%timetable_lesson}}".
 *
 * @property int $id
 * @property int $timetable_id
 * @property int $sort_order
 * @property string $lesson
 * @property string $room
 *
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
            [['timetable_id'], 'required'],
            [['timetable_id', 'sort_order'], 'integer'],
            [['lesson', 'room'], 'string', 'max' => 255],
            [['timetable_id'], 'exist', 'skipOnError' => true, 'targetClass' => Timetable::className(), 'targetAttribute' => ['timetable_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'timetable_id' => Yii::t('common', 'Timetable ID'),
            'sort_order' => Yii::t('common', 'Sort Order'),
            'lesson' => Yii::t('common', 'Lesson'),
            'room' => Yii::t('common', 'Room'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTimetable()
    {
        return $this->hasOne(Timetable::className(), ['id' => 'timetable_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\TimetableLessonQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TimetableLessonQuery(get_called_class());
    }
}
