<?php

namespace frontend\models;

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
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('frontend', 'ID'),
            'room_id' => Yii::t('frontend', 'Room ID'),
            'published' => Yii::t('frontend', 'Published'),
            'sort_order' => Yii::t('frontend', 'Sort Order'),
            'teacher_group_id' => Yii::t('frontend', 'Teacher Group ID'),
            'image_id' => Yii::t('frontend', 'Image ID'),
            'created_by' => Yii::t('frontend', 'Created By'),
            'updated_by' => Yii::t('frontend', 'Updated By'),
            'created_at' => Yii::t('frontend', 'Created At'),
            'updated_at' => Yii::t('frontend', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function getLeaders()
    {
        $lang = Language::getLanguageIdByCode(Yii::$app->language);

        return self::find()
                ->select([
                    'teachers.*', 
                    'teachers_description.name AS name', 
                    'teachers_description.description AS description', 
                    'images.src AS src',
                    'images_description.name AS title', 
                    'images_description.description AS alt',
                    '(SELECT number FROM rooms_description WHERE rooms_description.room_id = teachers.room_id AND rooms_description.language_id = '.$lang['id'].') AS number'
                ])
                ->leftJoin('teachers_description', 'teachers_description.teacher_id = teachers.id')
                ->leftJoin('images', 'images.id = teachers.image_id')
                ->leftJoin('images_description', 'images_description.image_id = images.id')
                ->where([
                    'teachers.published' => 1, 
                    'teachers.teacher_group_id' => 1, 
                    'teachers_description.language_id' => $lang['id'], 
                    'images_description.language_id' => $lang['id']
                ])
                ->asArray()
                ->all();
    }

    /**
     * {@inheritdoc}
     */
    public static function getTeachers()
    {
        $lang = Language::getLanguageIdByCode(Yii::$app->language);
        
        return self::find()
                ->select([
                    'teachers.*', 
                    'teachers_description.name AS name', 
                    'teachers_description.description AS description', 
                    'images.src AS src',
                    'images_description.name AS title', 
                    'images_description.description AS alt',
                    '(SELECT number FROM rooms_description WHERE rooms_description.room_id = teachers.room_id AND rooms_description.language_id = '.$lang['id'].') AS number'
                ])
                ->leftJoin('teachers_description', 'teachers_description.teacher_id = teachers.id')
                ->leftJoin('images', 'images.id = teachers.image_id')
                ->leftJoin('images_description', 'images_description.image_id = images.id')
                ->where([
                    'teachers.published' => 1,
                    'teachers.teacher_group_id' => 2,
                    'teachers_description.language_id' => $lang['id'],
                    'images_description.language_id' => $lang['id']])
                ->asArray()
                ->all();
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
