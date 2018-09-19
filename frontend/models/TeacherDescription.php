<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%teachers_description}}".
 *
 * @property int $teacher_id
 * @property int $language_id
 * @property string $name
 * @property string $description
 *
 * @property Languages $language
 * @property Teachers $teacher
 */
class TeacherDescription extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%teachers_description}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['teacher_id', 'language_id'], 'required'],
            [['teacher_id', 'language_id'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['language_id' => 'id']],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teacher::className(), 'targetAttribute' => ['teacher_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'teacher_id' => Yii::t('frontend', 'Teacher ID'),
            'language_id' => Yii::t('frontend', 'Language ID'),
            'name' => Yii::t('frontend', 'Name'),
            'description' => Yii::t('frontend', 'Description'),
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
    public function getTeacher()
    {
        return $this->hasOne(Teacher::className(), ['id' => 'teacher_id']);
    }
}
