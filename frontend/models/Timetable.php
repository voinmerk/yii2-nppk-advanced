<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
use common\models\User;

/**
 * This is the model class for table "{{%timetable}}".
 *
 * @property int $id
 * @property string $date
 * @property int $group_id
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Group $group
 * @property User $createdBy
 * @property User $updatedBy
 * @property TimetableLesson[] $timetableLessons
 */
class Timetable extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%timetable}}';
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
            'id' => 'ID',
            'date' => 'Date',
            'group_id' => 'Group ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function getTimetablesByGroup($group)
    {
        return self::find()->with(['timetableLessons'])->where(['group_id' => $group])->andWhere('date >= :date', [':date' => date('Y-m-d')])->limit(3)->all();
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
    public function getTimetableLessons()
    {
        return $this->hasMany(TimetableLesson::className(), ['timetable_id' => 'id'])->orderBy(['sort_order' => SORT_ASC]);
    }
}
