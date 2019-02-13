<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%room}}".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int $sort_order
 * @property int $status
 * @property int $image_id
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Image $image
 * @property User $createdBy
 * @property User $updatedBy
 */
class Room extends ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%room}}';
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
                'filePath' => '@uploads/news/[[filename]].[[extension]]',
                'fileUrl' => '/data/news/[[filename]].[[extension]]',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'created_at', 'updated_at'], 'required'],
            [['content'], 'string'],
            [['sort_order', 'status', 'image_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'extensions' => 'jpeg, gif, png, jpg'],
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
            'content' => Yii::t('common', 'Content'),
            'sort_order' => Yii::t('common', 'Sort Order'),
            'status' => Yii::t('common', 'Published'),
            'image_id' => Yii::t('common', 'Image ID'),
            'created_by' => Yii::t('common', 'Created By'),
            'updated_by' => Yii::t('common', 'Updated By'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),

            'createdName' => Yii::t('common', 'Created Name'),
            'updatedName' => Yii::t('common', 'Updated Name'),
            'statusName' => Yii::t('common', 'Published'),
            'imageFile' => Yii::t('common', 'Upload image'),
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

        $imageModel = new Image;

        $imageModel->src = '/data/rooms/' . $this->imageFile;

        if ($imageModel->save()) {
            $this->image_id = $imageModel->id;
        }

        return true;
    }

    /**
     * Backend template
     */
    public static function getAutocompleteRooms()
    {
        return self::find()->select('title')->active()->column();
    }

    /**
     * Frontend template
     */
    public static function getRooms()
    {
        return self::find()->with(['image'])->active()->all();
    }

    /**
     * Frontend template
     */
    public static function getRoomById($id)
    {
        return self::find()->with(['images'])->where(['id' => $id])->active()->one();
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
    public function getImages()
    {
        return $this->hasMany(Image::className(), ['id' => 'image_id'])->viaTable('room_to_image', ['room_id' => 'id']);
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
     * @return \common\models\query\RoomQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RoomQuery(get_called_class());
    }
}
