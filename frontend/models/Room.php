<?php

namespace frontend\models;

use Yii;

use common\models\User;

/**
 * This is the model class for table "{{%rooms}}".
 *
 * @property int $id
 * @property int $sort_order
 * @property int $published
 * @property int $image_id
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Images $image
 * @property Users $createdBy
 * @property Users $updatedBy
 * @property RoomsDescription[] $roomsDescriptions
 * @property RoomsImage[] $roomsImages
 * @property TimetablesLesson[] $timetablesLessons
 */
class Room extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%rooms}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sort_order', 'published', 'image_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['created_at', 'updated_at'], 'required'],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['image_id' => 'id']],
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
            'sort_order' => Yii::t('frontend', 'Sort Order'),
            'published' => Yii::t('frontend', 'Published'),
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
    public static function getRooms()
    {
        $lang = Language::getLanguageIdByCode(Yii::$app->language);

        return self::find()
                    ->select([
                        'rooms.*', 
                        'rooms_description.number AS number', 
                        'rooms_description.name AS name', 
                        'images.src AS src', 
                        'images_description.name AS title', 
                        'images_description.description AS alt'
                    ])
                    ->leftJoin('rooms_description', 'rooms_description.room_id = rooms.id')
                    ->leftJoin('images', 'images.id = rooms.image_id')
                    ->leftJoin('images_description', 'images_description.image_id = images.id')
                    ->where([
                        'rooms.published' => 1, 
                        'rooms_description.language_id' => $lang['id'], 
                        'images_description.language_id' => $lang['id']
                    ])
                    ->orderBy('rooms.sort_order')
                    ->asArray()
                    ->all();
    }

    /**
     * {@inheritdoc}
     */
    public static function getRoomById($id)
    {
        return self::find()
                    ->select([
                        'rooms.*', 
                        'rooms_description.number AS number', 
                        'rooms_description.name AS name'
                    ])
                    ->leftJoin('rooms_description', 'rooms_description.room_id = rooms.id')
                    ->where([
                        'rooms.id' => $id, 
                        'rooms_description.language_id' => Language::getLanguageIdByCode(Yii::$app->language)
                    ])
                    ->asArray()
                    ->one();
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
    public function getRoomsDescriptions()
    {
        return $this->hasMany(RoomDescription::className(), ['room_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomsImages()
    {
        return $this->hasMany(RoomImage::className(), ['room_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTimetablesLessons()
    {
        return $this->hasMany(TimetableLesson::className(), ['room_id' => 'id']);
    }
}
