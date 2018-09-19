<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%teachers_group_description}}".
 *
 * @property int $teacher_group_id
 * @property int $language_id
 * @property string $name
 *
 * @property Languages $language
 * @property TeachersGroup $teacherGroup
 */
class TeacherGroupDescription extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%teachers_group_description}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['teacher_group_id', 'language_id'], 'required'],
            [['teacher_group_id', 'language_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['language_id' => 'id']],
            [['teacher_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => TeacherGroup::className(), 'targetAttribute' => ['teacher_group_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'teacher_group_id' => Yii::t('backend', 'Teacher Group ID'),
            'language_id' => Yii::t('backend', 'Language ID'),
            'name' => Yii::t('backend', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::className(), ['id' => 'language_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacherGroup()
    {
        return $this->hasOne(TeacherGroup::className(), ['id' => 'teacher_group_id']);
    }
}
