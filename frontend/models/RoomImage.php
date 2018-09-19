<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%rooms_image}}".
 *
 * @property int $room_id
 * @property int $image_id
 *
 * @property Images $image
 * @property Rooms $room
 */
class RoomImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%rooms_image}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['room_id', 'image_id'], 'required'],
            [['room_id', 'image_id'], 'integer'],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['image_id' => 'id']],
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
            'image_id' => Yii::t('frontend', 'Image ID'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function getRoomImageById($id)
    {
        return self::find()->where(['room_id' => $id])->with(['image'])->asArray()->all();
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
    public function getRoom()
    {
        return $this->hasOne(Room::className(), ['id' => 'room_id']);
    }
}
