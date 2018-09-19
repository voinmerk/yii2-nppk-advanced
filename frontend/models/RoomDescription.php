<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%rooms_description}}".
 *
 * @property int $room_id
 * @property int $language_id
 * @property string $number
 * @property string $name
 * @property string $description
 *
 * @property Languages $language
 * @property Rooms $room
 */
class RoomDescription extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%rooms_description}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['room_id', 'language_id'], 'required'],
            [['room_id', 'language_id'], 'integer'],
            [['description'], 'string'],
            [['number', 'name'], 'string', 'max' => 255],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['language_id' => 'id']],
            [['room_id'], 'exist', 'skipOnError' => true, 'targetClass' => Room::className(), 'targetAttribute' => ['room_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'room_id' => Yii::t('frontend', 'Room ID'),
            'language_id' => Yii::t('frontend', 'Language ID'),
            'number' => Yii::t('frontend', 'Number'),
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
    public function getRoom()
    {
        return $this->hasOne(Room::className(), ['id' => 'room_id']);
    }
}
