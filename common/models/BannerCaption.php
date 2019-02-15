<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%banner_caption}}".
 *
 * @property int $id
 * @property string $title
 * @property string $btn_caption
 * @property string $btn_link
 * @property int $btn_status
 * @property int $status
 * @property int $banner_id
 * @property int $image_id
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Banner $banner
 * @property Image $image
 * @property User $createdBy
 * @property User $updatedBy
 */
class BannerCaption extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%banner_caption}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'blame' => [
                'class' => \yii\behaviors\BlameableBehavior::className(),
            ],
            'timestamp' => [
                'class' => \yii\behaviors\TimestampBehavior::className(),
            ],
            'imageUpload' => [
                'class' => \yiidreamteam\upload\ImageUploadBehavior::className(),
                'attribute' => 'imageFile',
                'filePath' => '@uploads/banner/[[filename]].[[extension]]',
                'fileUrl' => '/data/banner/[[filename]].[[extension]]',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['btn_status', 'status', 'banner_id', 'image_id'], 'integer'],
            [['banner_id', 'image_id'], 'required'],
            [['title', 'btn_caption', 'btn_link'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'extensions' => 'jpeg, gif, png, jpg'],
            [['banner_id'], 'exist', 'skipOnError' => true, 'targetClass' => Banner::className(), 'targetAttribute' => ['banner_id' => 'id']],
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
            'id' => Yii::t('common', 'ID'),
            'title' => Yii::t('common', 'Title'),
            'btn_caption' => Yii::t('common', 'Btn Caption'),
            'btn_link' => Yii::t('common', 'Btn Link'),
            'btn_status' => Yii::t('common', 'Btn Status'),
            'status' => Yii::t('common', 'Status'),
            'banner_id' => Yii::t('common', 'Banner ID'),
            'image_id' => Yii::t('common', 'Image ID'),
            'created_by' => Yii::t('common', 'Created By'),
            'updated_by' => Yii::t('common', 'Updated By'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),

            'createdName' => Yii::t('common', 'Created Name'),
            'updatedName' => Yii::t('common', 'Updated Name'),
            'statusName' => Yii::t('common', 'Published'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        var_dump($this->imageFile);exit;

        if ($this->imageFile) {
            $imageModel = new Image;

            $imageModel->src = '/data/banner/' . $this->imageFile;

            if ($imageModel->save()) {
                $this->image_id = $imageModel->id;
            }
        }

        return true;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBanner()
    {
        return $this->hasOne(Banner::className(), ['id' => 'banner_id']);
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
     * {@inheritdoc}
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
            self::STATUS_INACTIVE => Yii::t('common', 'Unpublished'),
            self::STATUS_ACTIVE => Yii::t('common', 'Published'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getStatusName()
    {
        $statusList = self::getStatusList();

        return $statusList[$this->status];
    }

    /**
     * {@inheritdoc}
     */
    public function getBtnStatusName()
    {
        $statusList = self::getStatusList();

        return $statusList[$this->btn_status];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\BannerCaptionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\BannerCaptionQuery(get_called_class());
    }
}
