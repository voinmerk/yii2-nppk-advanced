<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%users}}".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property int $status
 * @property int $user_group_id
 * @property int $user_permission_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property BannersImage[] $frontendBannersImages
 * @property BannersImage[] $frontendBannersImages0
 * @property Blogs[] $frontendBlogs
 * @property Blogs[] $frontendBlogs0
 * @property BlogsMenu[] $frontendBlogsMenus
 * @property BlogsMenu[] $frontendBlogsMenus0
 * @property Groups[] $frontendGroups
 * @property Groups[] $frontendGroups0
 * @property Images[] $frontendImages
 * @property Images[] $frontendImages0
 * @property Languages[] $frontendLanguages
 * @property Languages[] $frontendLanguages0
 * @property LanguagesPhrase[] $frontendLanguagesPhrases
 * @property LanguagesPhrase[] $frontendLanguagesPhrases0
 * @property Lessons[] $frontendLessons
 * @property Lessons[] $frontendLessons0
 * @property Rooms[] $frontendRooms
 * @property Rooms[] $frontendRooms0
 * @property Teachers[] $frontendTeachers
 * @property Teachers[] $frontendTeachers0
 * @property TeachersGroup[] $frontendTeachersGroups
 * @property TeachersGroup[] $frontendTeachersGroups0
 * @property Timetables[] $frontendTimetables
 * @property Timetables[] $frontendTimetables0
 * @property UsersGroup $frontendUserGroup
 * @property UsersPermission $frontendUserPermission
 * @property UsersGroup[] $frontendUsersGroups
 * @property UsersGroup[] $frontendUsersGroups0
 *
 * @property BannersImage[] $backendBannersImages
 * @property BannersImage[] $backendBannersImages0
 * @property Blogs[] $backendBlogs
 * @property Blogs[] $backendBlogs0
 * @property BlogsMenu[] $backendBlogsMenus
 * @property BlogsMenu[] $backendBlogsMenus0
 * @property Groups[] $backendGroups
 * @property Groups[] $backendGroups0
 * @property Images[] $backendImages
 * @property Images[] $backendImages0
 * @property Languages[] $backendLanguages
 * @property Languages[] $backendLanguages0
 * @property LanguagesPhrase[] $backendLanguagesPhrases
 * @property LanguagesPhrase[] $backendLanguagesPhrases0
 * @property Lessons[] $backendLessons
 * @property Lessons[] $backendLessons0
 * @property Rooms[] $backendRooms
 * @property Rooms[] $backendRooms0
 * @property Teachers[] $backendTeachers
 * @property Teachers[] $backendTeachers0
 * @property TeachersGroup[] $backendTeachersGroups
 * @property TeachersGroup[] $backendTeachersGroups0
 * @property Timetables[] $backendTimetables
 * @property Timetables[] $backendTimetables0
 * @property UsersGroup $backendUserGroup
 * @property UsersPermission $backendUserPermission
 * @property UsersGroup[] $backendUsersGroups
 * @property UsersGroup[] $backendUsersGroups0
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['status', 'user_group_id', 'user_permission_id', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['first_name', 'last_name'], 'string', 'max' => 64],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['user_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => \frontend\models\UserGroup::className(), 'targetAttribute' => ['user_group_id' => 'id']],
            [['user_permission_id'], 'exist', 'skipOnError' => true, 'targetClass' => \frontend\models\UserPermission::className(), 'targetAttribute' => ['user_permission_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'username' => Yii::t('common', 'Username'),
            'auth_key' => Yii::t('common', 'Auth Key'),
            'password_hash' => Yii::t('common', 'Password Hash'),
            'password_reset_token' => Yii::t('common', 'Password Reset Token'),
            'email' => Yii::t('common', 'Email'),
            'first_name' => Yii::t('common', 'First Name'),
            'last_name' => Yii::t('common', 'Last Name'),
            'status' => Yii::t('common', 'Status'),
            'user_group_id' => Yii::t('common', 'User Group ID'),
            'user_permission_id' => Yii::t('common', 'User Permission ID'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    //-------------------------------------------------------------------------------------------------
    // Связи для frontend

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrontendBannersImages()
    {
        return $this->hasMany(\frontend\models\BannerImage::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrontendBannersImages0()
    {
        return $this->hasMany(\frontend\models\BannerImage::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrontendBlogs()
    {
        return $this->hasMany(\frontend\models\Blog::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrontendBlogs0()
    {
        return $this->hasMany(\frontend\models\Blog::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrontendBlogsMenus()
    {
        return $this->hasMany(\frontend\models\BlogMenu::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrontendBlogsMenus0()
    {
        return $this->hasMany(\frontend\models\BlogMenu::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrontendGroups()
    {
        return $this->hasMany(\frontend\models\Group::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrontendGroups0()
    {
        return $this->hasMany(\frontend\models\Group::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrontendImages()
    {
        return $this->hasMany(\frontend\models\Image::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrontendImages0()
    {
        return $this->hasMany(\frontend\models\Image::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrontendLanguages()
    {
        return $this->hasMany(\frontend\models\Language::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrontendLanguages0()
    {
        return $this->hasMany(\frontend\models\Language::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrontendLanguagesPhrases()
    {
        return $this->hasMany(\frontend\models\LanguagePhrase::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrontendLanguagesPhrases0()
    {
        return $this->hasMany(\frontend\models\LanguagePhrase::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrontendLessons()
    {
        return $this->hasMany(\frontend\models\Lesson::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrontendLessons0()
    {
        return $this->hasMany(\frontend\models\Lesson::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrontendRooms()
    {
        return $this->hasMany(\frontend\models\Room::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrontendRooms0()
    {
        return $this->hasMany(\frontend\models\Room::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrontendTeachers()
    {
        return $this->hasMany(\frontend\models\Teacher::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrontendTeachers0()
    {
        return $this->hasMany(\frontend\models\Teacher::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrontendTeachersGroups()
    {
        return $this->hasMany(\frontend\models\TeacherGroup::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrontendTeachersGroups0()
    {
        return $this->hasMany(\frontend\models\TeacherGroup::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrontendTimetables()
    {
        return $this->hasMany(\frontend\models\Timetable::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrontendTimetables0()
    {
        return $this->hasMany(\frontend\models\Timetable::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrontendUserGroup()
    {
        return $this->hasOne(\frontend\models\UserGroup::className(), ['id' => 'user_group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrontendUserPermission()
    {
        return $this->hasOne(\frontend\models\UserPermission::className(), ['id' => 'user_permission_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrontendUsersGroups()
    {
        return $this->hasMany(\frontend\models\UserGroup::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrontendUsersGroups0()
    {
        return $this->hasMany(\frontend\models\UserGroup::className(), ['updated_by' => 'id']);
    }

    //-------------------------------------------------------------------------------------------------
    // Связи для backend

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBackendBannersImages()
    {
        return $this->hasMany(\backend\models\BannerImage::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBackendBannersImages0()
    {
        return $this->hasMany(\backend\models\BannerImage::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBackendBlogs()
    {
        return $this->hasMany(\backend\models\Blog::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBackendBlogs0()
    {
        return $this->hasMany(\backend\models\Blog::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBackendBlogsMenus()
    {
        return $this->hasMany(\backend\models\BlogMenu::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBackendBlogsMenus0()
    {
        return $this->hasMany(\backend\models\BlogMenu::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBackendGroups()
    {
        return $this->hasMany(\backend\models\Group::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBackendGroups0()
    {
        return $this->hasMany(\backend\models\Group::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBackendImages()
    {
        return $this->hasMany(\backend\models\Image::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBackendImages0()
    {
        return $this->hasMany(\backend\models\Image::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBackendLanguages()
    {
        return $this->hasMany(\backend\models\Language::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBackendLanguages0()
    {
        return $this->hasMany(\backend\models\Language::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBackendLanguagesPhrases()
    {
        return $this->hasMany(\backend\models\LanguagePhrase::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBackendLanguagesPhrases0()
    {
        return $this->hasMany(\backend\models\LanguagePhrase::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBackendLessons()
    {
        return $this->hasMany(\backend\models\Lesson::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBackendLessons0()
    {
        return $this->hasMany(\backend\models\Lesson::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBackendRooms()
    {
        return $this->hasMany(\backend\models\Room::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBackendRooms0()
    {
        return $this->hasMany(\backend\models\Room::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBackendTeachers()
    {
        return $this->hasMany(\backend\models\Teacher::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBackendTeachers0()
    {
        return $this->hasMany(\backend\models\Teacher::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBackendTeachersGroups()
    {
        return $this->hasMany(\backend\models\TeacherGroup::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBackendTeachersGroups0()
    {
        return $this->hasMany(\backend\models\TeacherGroup::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBackendTimetables()
    {
        return $this->hasMany(\backend\models\Timetable::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBackendTimetables0()
    {
        return $this->hasMany(\backend\models\Timetable::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBackendUserGroup()
    {
        return $this->hasOne(\backend\models\UserGroup::className(), ['id' => 'user_group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBackendUserPermission()
    {
        return $this->hasOne(\backend\models\UserPermission::className(), ['id' => 'user_permission_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBackendUsersGroups()
    {
        return $this->hasMany(\backend\models\UserGroup::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBackendUsersGroups0()
    {
        return $this->hasMany(\backend\models\UserGroup::className(), ['updated_by' => 'id']);
    }
}
