<?php

namespace backend\models;

use Yii;

use common\models\User;

/**
 * This is the model class for table "{{%teachers}}".
 *
 * @property int $id
 * @property int $room_id
 * @property int $published
 * @property int $sort_order
 * @property int $teacher_group_id
 * @property int $image_id
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Images $image
 * @property TeachersGroup $teacherGroup
 * @property Users $createdBy
 * @property Users $updatedBy
 * @property TeachersDescription[] $teachersDescriptions
 */
class Teacher extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%teachers}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['room_id', 'created_at', 'updated_at'], 'required'],
            [['room_id', 'published', 'sort_order', 'teacher_group_id', 'image_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['image_id' => 'id']],
            [['teacher_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => TeacherGroup::className(), 'targetAttribute' => ['teacher_group_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaveriors()
    {
        return [
            'blame' => [
                'class' => \yii\behaveriors\BlameableBehavior::className(),
            ],
            'timestamp' => [
                'class' => \yii\behaveriors\TimestampBehavior::className(),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'room_id' => Yii::t('backend', 'Room ID'),
            'published' => Yii::t('backend', 'Published'),
            'sort_order' => Yii::t('backend', 'Sort Order'),
            'teacher_group_id' => Yii::t('backend', 'Teacher Group ID'),
            'image_id' => Yii::t('backend', 'Image ID'),
            'created_by' => Yii::t('backend', 'Created By'),
            'updated_by' => Yii::t('backend', 'Updated By'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Image::className(), ['id' => 'image_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacherGroup()
    {
        return $this->hasOne(TeacherGroup::className(), ['id' => 'teacher_group_id']);
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
    public function getTeachersDescriptions()
    {
        return $this->hasMany(TeacherDescription::className(), ['teacher_id' => 'id']);
    }
}
