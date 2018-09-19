<?php

namespace frontend\models;

use Yii;

use common\models\User;

/**
 * This is the model class for table "{{%timetables}}".
 *
 * @property int $id
 * @property string $date
 * @property int $group_id
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Groups $group
 * @property Users $createdBy
 * @property Users $updatedBy
 * @property TimetablesLesson[] $timetablesLessons
 */
class Timetable extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%timetables}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'group_id', 'created_at', 'updated_at'], 'required'],
            [['date'], 'safe'],
            [['group_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['group_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('frontend', 'ID'),
            'date' => Yii::t('frontend', 'Date'),
            'group_id' => Yii::t('frontend', 'Group ID'),
            'created_by' => Yii::t('frontend', 'Created By'),
            'updated_by' => Yii::t('frontend', 'Updated By'),
            'created_at' => Yii::t('frontend', 'Created At'),
            'updated_at' => Yii::t('frontend', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function getTimetables($id)
    {
        return self::find()
                ->where(['timetables.group_id' => $id])
                ->andWhere('timetables.date >= :date', [':date' => date('Y-m-d')])
                ->orderBy('timetables.date')
                ->limit(3)
                ->asArray()
                ->all();
    }

    /**
     * {@inheritdoc}
     */
    public static function getTimetablesBeta($id)
    {
        return self::find()
                //->leftJoin('timetables_lesson', 'timetables_lesson.timetable_id = timetables.id')
                ->where(['timetables.group_id' => $id])
                ->andWhere('timetables.date >= :date', [':date' => date('Y-m-d')])
                ->orderBy('timetables.date')
                ->with(['timetablesLessons'])
                ->limit(3)
                ->asArray()
                ->all();
    }

    /**
     * {@inheritdoc}
     */
    public static function getLessons($id)
    {
        return self::find()
                ->select(['timetables.*', 'timetables_lesson.sort AS sort', 'timetables_lesson.lesson AS lesson', 'timetables_lesson.room AS room'])
                ->leftJoin('timetables_lesson', 'timetables_lesson.timetable_id = timetables.id')
                ->where(['timetables.id' => $id])
                ->orderBy('timetables_lesson.sort')
                ->limit(6)
                ->asArray()
                ->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTimetablesLessons()
    {
        return $this->hasMany(TimetableLesson::className(), ['timetable_id' => 'id']);
    }
}
