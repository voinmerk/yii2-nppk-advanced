<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%lessons_description}}".
 *
 * @property int $lesson_id
 * @property int $language_id
 * @property string $name
 * @property string $description
 *
 * @property Languages $language
 * @property Lessons $lesson
 */
class LessonDescription extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%lessons_description}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lesson_id', 'language_id'], 'required'],
            [['lesson_id', 'language_id'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['language_id' => 'id']],
            [['lesson_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lesson::className(), 'targetAttribute' => ['lesson_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'lesson_id' => Yii::t('frontend', 'Lesson ID'),
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
    public function getLesson()
    {
        return $this->hasOne(Lesson::className(), ['id' => 'lesson_id']);
    }
}
