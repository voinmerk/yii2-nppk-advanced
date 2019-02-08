<?php

namespace backend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "{{%image}}".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $src
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property BannerImage[] $bannerImages
 * @property User $createdBy
 * @property User $updatedBy
 * @property Room[] $rooms
 * @property Teacher[] $teachers
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%image}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => \yii\behaviors\TimestampBehavior::className(),
            ],
            'blame' => [
                'class' => \yii\behaviors\BlameableBehavior::className(),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['src'], 'required'],
            [['created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['title', 'src'], 'string', 'max' => 255],
            [['src'], 'unique'],
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
            'id' => Yii::t('backend', 'ID'),
            'title' => Yii::t('backend', 'Title'),
            'content' => Yii::t('backend', 'Content'),
            'src' => Yii::t('backend', 'Source'),
            'created_by' => Yii::t('backend', 'Created By'),
            'updated_by' => Yii::t('backend', 'Updated By'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),

            'statusName' => Yii::t('backend', 'Published'),
            'createdName' => Yii::t('backend', 'Created By'),
            'updatedName' => Yii::t('backend', 'Updated By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBannerImages()
    {
        return $this->hasMany(BannerImage::className(), ['image_id' => 'id']);
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
    public function getRooms()
    {
        return $this->hasMany(Room::className(), ['image_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeachers()
    {
        return $this->hasMany(Teacher::className(), ['image_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedName()
    {
        return $this->createdBy->username;
    }

    /**
     * {@inheritdoc}
     */
    public function getUpdatedName()
    {
        return $this->updatedBy->username;
    }

    /**
     * {@inheritdoc}
     */
    public static function getStatusList()
    {
        return [
            'Не опубликовано',
            'Опубликовано',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getStatusName()
    {
        $status = $this->getStatusList();

        return $status[$this->published];
    }
}
