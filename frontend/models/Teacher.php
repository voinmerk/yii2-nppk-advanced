<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
use common\models\User;

/**
 * This is the model class for table "{{%teacher}}".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int $room_id
 * @property int $status
 * @property int $sort_order
 * @property int $teacher_group_id
 * @property int $image_id
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Image $image
 * @property TeacherGroup $teacherGroup
 * @property User $createdBy
 * @property User $updatedBy
 */
class Teacher extends ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%teacher}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'room_id', 'created_at', 'updated_at'], 'required'],
            [['content'], 'string'],
            [['room_id', 'status', 'sort_order', 'teacher_group_id', 'image_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 50],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['image_id' => 'id']],
            [['teacher_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => TeacherGroup::className(), 'targetAttribute' => ['teacher_group_id' => 'id']],
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
            'title' => 'Title',
            'content' => 'Content',
            'room_id' => 'Room ID',
            'status' => 'Published',
            'sort_order' => 'Sort Order',
            'teacher_group_id' => 'Teacher Group ID',
            'image_id' => 'Image ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function getCollaboratorsByGroup($group)
    {
        return self::find()->with(['image', 'room'])->where(['teacher_group_id' => $group, 'status' => self::STATUS_ACTIVE])->all();
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
}
