<?php

namespace backend\models;

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
            'id' => Yii::t('backend', 'ID'),
            'blogs' => Yii::t('backend', 'Blogs'),
            'teachers' => Yii::t('backend', 'Teachers'),
            'images' => Yii::t('backend', 'Images'),
            'timetable' => Yii::t('backend', 'Timetable'),
            'lessons' => Yii::t('backend', 'Lessons'),
            'groups' => Yii::t('backend', 'Groups'),
            'rooms' => Yii::t('backend', 'Rooms'),
            'users' => Yii::t('backend', 'Users'),
            'languages' => Yii::t('backend', 'Languages'),
            'settings' => Yii::t('backend', 'Settings'),
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
