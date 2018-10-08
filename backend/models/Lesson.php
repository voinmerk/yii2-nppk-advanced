<?php

namespace backend\models;

use Yii;

use common\models\User;

/**
 * This is the model class for table "{{%lessons}}".
 *
 * @property int $id
 * @property int $published
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Users $createdBy
 * @property Users $updatedBy
 * @property LessonsDescription[] $lessonsDescriptions
 * @property TimetablesLesson[] $timetablesLessons
 */
class Lesson extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%lessons}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['published', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['created_at', 'updated_at'], 'required'],
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
            'published' => Yii::t('backend', 'Published'),
            'created_by' => Yii::t('backend', 'Created By'),
            'updated_by' => Yii::t('backend', 'Updated By'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),

            'name' => Yii::t('backend', 'Name'),
            'description' => Yii::t('backend', 'Description'),
            'createdName' => Yii::t('backend', 'Created Name'),
            'updatedName' => Yii::t('backend', 'Updated Name'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function getList()
    {
        $query = self::find()
                    ->select([
                        'lessons.*',
                        'ld.name AS name',
                        'ld.description AS description',
                    ])
                    ->joinWith([
                        'lessonsDescriptions' => function($q) {
                            $q->from(['ld' => LessonDescription::tableName()]);
                        },
                    ])
                    ->where('ld.language_id = 1')
                    ->all();

        return $query;
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
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedName()
    {
        return $this->updatedBy->username;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLessonsDescriptions()
    {
        return $this->hasMany(LessonDescription::className(), ['lesson_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getName()
    {
        return $this->lessonsDescriptions[0]->name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDescription()
    {
        return $this->lessonsDescriptions[0]->description;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTimetablesLessons()
    {
        return $this->hasMany(TimetableLesson::className(), ['lesson_id' => 'id']);
    }
}
