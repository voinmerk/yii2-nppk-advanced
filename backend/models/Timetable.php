<?php

namespace backend\models;

use Yii;
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
class Timetable extends \yii\db\ActiveRecord
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
            'date' => 'Дата',
            'group_id' => 'Номер группы',
            'created_by' => 'Автор',
            'updated_by' => 'Модератор',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',

            'groupName' => 'Номер группы',
            'createdName' => 'Автор',
            'updatedName' => 'Модератор',
        ];
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
        return $this->hasMany(TimetableLesson::className(), ['timetable_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return Group::find()->where(['published' => Group::PUBLISHED])->all();
    }

    /**
     * {@inheritdoc}
     */
    public function getGroupList()
    {
        $groupList = \yii\helpers\ArrayHelper::map($this->groups, 'id', 'name');

        return $groupList;
    }

    /**
     * {@inheritdoc}
     */
    public function getGroupName()
    {
        return $this->group->name;
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedName()
    {
        return $this->createdBy->username;
    }

    /**
     * {@inheritdoc}
     */
    public function getUpdatedName()
    {
        return $this->updatedBy->username;
    }
}
