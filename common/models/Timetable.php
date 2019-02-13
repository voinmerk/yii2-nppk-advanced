<?php

namespace common\models;

use Yii;

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
    public function behaviors()
    {
        return [
            'blame' => [
                'class' => \yii\behaviors\BlameableBehavior::className(),
            ],
            'timestamp' => [
                'class' => \yii\behaviors\TimestampBehavior::className(),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'group_id'], 'required'],
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
            'id' => Yii::t('common', 'ID'),
            'date' => Yii::t('common', 'Date'),
            'group_id' => Yii::t('common', 'Group ID'),
            'created_by' => Yii::t('common', 'Created By'),
            'updated_by' => Yii::t('common', 'Updated By'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
        ];
    }

    /**
     * Frontend template
     */
    public static function getTimetablesByGroup($group)
    {
        return self::find()->with(['timetableLessons'])->where(['group_id' => $group])->andWhere('date >= :date', [':date' => date('Y-m-d')])->limit(3)->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return Group::find()->active()->all();
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
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function getGroupName()
    {
        return $this->group->name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedName()
    {
        return $this->createdBy->username;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * {@inheritdoc}
     */
    public function getUpdatedName()
    {
        return $this->updatedBy->username;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTimetableLessons()
    {
        return $this->hasMany(TimetableLesson::className(), ['timetable_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\TimetableQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TimetableQuery(get_called_class());
    }
}
