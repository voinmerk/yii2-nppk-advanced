<?php

namespace backend\models;

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
            'sort_order' => Yii::t('backend', 'Sort Order'),
            'published' => Yii::t('backend', 'Published'),
            'image_id' => Yii::t('backend', 'Image ID'),
            'created_by' => Yii::t('backend', 'Created By'),
            'updated_by' => Yii::t('backend', 'Updated By'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),

            'number' => Yii::t('backend', 'Number'),
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
        return self::find()
                    ->select([
                        'rooms.*',
                        'rd.number AS number',
                        'rd.name AS name',
                        'rd.description AS description',
                    ])
                    ->joinWith([
                        'roomsDescriptions' => function($q) {
                            $q->from(['rd' => RoomDescription::tableName()]);
                        },
                    ])
                    ->where('rd.language_id = 1')
                    ->all();
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
    public function getRoomsDescriptions()
    {
        return $this->hasMany(RoomDescription::className(), ['room_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNumber()
    {
        return $this->roomsDescriptions[0]->number;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getName()
    {
        return $this->roomsDescriptions[0]->name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDescription()
    {
        return $this->roomsDescriptions[0]->description;
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
