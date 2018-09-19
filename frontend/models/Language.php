<?php

namespace frontend\models;

use Yii;

use common\models\User;

/**
 * This is the model class for table "{{%languages}}".
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string $locale
 * @property string $icon
 * @property int $default
 * @property int $published
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property BlogsDescription[] $blogsDescriptions
 * @property BlogsMenuDescription[] $blogsMenuDescriptions
 * @property ImagesDescription[] $imagesDescriptions
 * @property Users $createdBy
 * @property Users $updatedBy
 * @property LanguagesPhraseValue[] $languagesPhraseValues
 * @property LessonsDescription[] $lessonsDescriptions
 * @property RoomsDescription[] $roomsDescriptions
 * @property Settings[] $settings
 * @property TeachersDescription[] $teachersDescriptions
 * @property TeachersGroupDescription[] $teachersGroupDescriptions
 */
class Language extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%languages}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'code', 'locale', 'icon', 'created_at', 'updated_at'], 'required'],
            [['default', 'published', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['name', 'code', 'locale', 'icon'], 'string', 'max' => 255],
            [['code', 'locale'], 'unique', 'targetAttribute' => ['code', 'locale']],
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
            'name' => Yii::t('frontend', 'Name'),
            'code' => Yii::t('frontend', 'Code'),
            'locale' => Yii::t('frontend', 'Locale'),
            'icon' => Yii::t('frontend', 'Icon'),
            'default' => Yii::t('frontend', 'Default'),
            'published' => Yii::t('frontend', 'Published'),
            'created_by' => Yii::t('frontend', 'Created By'),
            'updated_by' => Yii::t('frontend', 'Updated By'),
            'created_at' => Yii::t('frontend', 'Created At'),
            'updated_at' => Yii::t('frontend', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function getLanguageIdByCode($code)
    {
        return self::find()->select(['id'])->from('languages')->where(['published' => 1, 'code' => $code])->asArray()->one();
    }

    /**
     * {@inheritdoc}
     */
    public static function getLanguages()
    {
        return self::find()->where(['published' => 1])->asArray()->all();
    }

    /**
     * {@inheritdoc}
     */
    public static function getLanguageByCode($code)
    {
        return self::find()->where(['published' => 1, 'code' => $code])->asArray()->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogsDescriptions()
    {
        return $this->hasMany(BlogDescription::className(), ['language_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogsMenuDescriptions()
    {
        return $this->hasMany(BlogMenuDescription::className(), ['language_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImagesDescriptions()
    {
        return $this->hasMany(ImageDescription::className(), ['language_id' => 'id']);
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
    public function getLanguagesPhraseValues()
    {
        return $this->hasMany(LanguagePhraseValue::className(), ['language_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLessonsDescriptions()
    {
        return $this->hasMany(LessonDescription::className(), ['language_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomsDescriptions()
    {
        return $this->hasMany(RoomDescription::className(), ['language_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSettings()
    {
        return $this->hasMany(Setting::className(), ['language_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeachersDescriptions()
    {
        return $this->hasMany(TeacherDescription::className(), ['language_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeachersGroupDescriptions()
    {
        return $this->hasMany(TeacherGroupDescription::className(), ['language_id' => 'id']);
    }
}
