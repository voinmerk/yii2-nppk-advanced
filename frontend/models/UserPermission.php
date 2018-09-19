<?php

namespace frontend\models;

use Yii;

use common\models\User;

/**
 * This is the model class for table "{{%users_permission}}".
 *
 * @property int $id
 * @property int $blogs
 * @property int $teachers
 * @property int $images
 * @property int $timetable
 * @property int $lessons
 * @property int $groups
 * @property int $rooms
 * @property int $users
 * @property int $languages
 * @property int $settings
 *
 * @property Users[] $users0
 */
class UserPermission extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%users_permission}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['blogs', 'teachers', 'images', 'timetable', 'lessons', 'groups', 'rooms', 'users', 'languages', 'settings'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('frontend', 'ID'),
            'blogs' => Yii::t('frontend', 'Blogs'),
            'teachers' => Yii::t('frontend', 'Teachers'),
            'images' => Yii::t('frontend', 'Images'),
            'timetable' => Yii::t('frontend', 'Timetable'),
            'lessons' => Yii::t('frontend', 'Lessons'),
            'groups' => Yii::t('frontend', 'Groups'),
            'rooms' => Yii::t('frontend', 'Rooms'),
            'users' => Yii::t('frontend', 'Users'),
            'languages' => Yii::t('frontend', 'Languages'),
            'settings' => Yii::t('frontend', 'Settings'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers0()
    {
        return $this->hasMany(User::className(), ['user_permission_id' => 'id']);
    }
}
