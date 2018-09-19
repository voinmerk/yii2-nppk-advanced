<?php

namespace backend\models;

use Yii;

use common\models\User;

/**
 * This is the model class for table "{{%teachers_group}}".
 *
 * @property int $id
 * @property string $slug
 * @property int $sort_order
 * @property int $published
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Teachers[] $teachers
 * @property Users $createdBy
 * @property Users $updatedBy
 * @property TeachersGroupDescription[] $teachersGroupDescriptions
 */
class TeacherGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%teachers_group}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['slug', 'created_at', 'updated_at'], 'required'],
            [['sort_order', 'published', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['slug'], 'string', 'max' => 255],
            [['slug'], 'unique'],
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
            'slug' => Yii::t('backend', 'Slug'),
            'sort_order' => Yii::t('backend', 'Sort Order'),
            'published' => Yii::t('backend', 'Published'),
            'created_by' => Yii::t('backend', 'Created By'),
            'updated_by' => Yii::t('backend', 'Updated By'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeachers()
    {
        return $this->hasMany(Teacher::className(), ['teacher_group_id' => 'id']);
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
    public function getTeachersGroupDescriptions()
    {
        return $this->hasMany(TeacherGroupDescription::className(), ['teacher_group_id' => 'id']);
    }
}
