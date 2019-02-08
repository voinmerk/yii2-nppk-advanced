<?php
namespace backend\models;

use Yii;
use yii\db\ActiveRecord;

use common\models\User;

/**
 * This is the model class for table "{{%news}}".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string $slug
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
class News extends ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public $image_file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%news}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => '\yii\behaviors\TimestampBehavior',
            ],
            'blame' => [
                'class' => '\yii\behaviors\BlameableBehavior',
            ],
            'imageUpload' => [
                'class' => '\yiidreamteam\upload\ImageUploadBehavior',
                'attribute' => 'image_file',
                /*'thumbs' => [
                    'thumb' => ['width' => 700, 'height' => 700],
                ],*/
                'filePath' => '@uploads/news/[[filename]].[[extension]]',
                'fileUrl' => '/data/news/[[filename]].[[extension]]',
                //'thumbPath' => '@uploads/news/[[profile]]_[[filename]].[[extension]]',
                //'thumbUrl' => '/data/news/[[profile]]_[[filename]].[[extension]]',
            ],
            'slug' => [
                'class' => '\yii\behaviors\SluggableBehavior',
                //'attribute' => 'title',
                //'slugAttribute' => 'slug',
                'ensureUnique' => true,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['title'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'title',
                ],
                'value'  => function ($event)  {
                    return $event->sender->slug;
                },
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'content', 'meta_title', 'slug', 'image_file'], 'required'],
            [['content', 'meta_keywords', 'meta_description'], 'string'],
            [['status', 'image_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['title', 'meta_title', 'slug'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            [['image_file'], 'file', 'extensions' => 'jpeg, gif, png, jpg'],
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
            'id' => Yii::t('backend', 'ID'),
            'title' => Yii::t('backend', 'Title'),
            'content' => Yii::t('backend', 'Content'),
            'meta_title' => Yii::t('backend', 'Meta Title'),
            'meta_keywords' => Yii::t('backend', 'Meta Keywords'),
            'meta_description' => Yii::t('backend', 'Meta Description'),
            'slug' => Yii::t('backend', 'Slug'),
            'status' => Yii::t('backend', 'Status'),
            'image_id' => Yii::t('backend', 'Image ID'),
            'created_by' => Yii::t('backend', 'Created By'),
            'updated_by' => Yii::t('backend', 'Updated By'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
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

        $imageModel->src = '/data/news/' . $this->image_file;

        if ($imageModel->save()) {
            $this->image_id = $imageModel->id;
        }

        return true;
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
            self::STATUS_INACTIVE => Yii::t('backend', 'Unpublished'),
            self::STATUS_ACTIVE => Yii::t('backend', 'Published'),
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
     * @return NewsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NewsQuery(get_called_class());
    }
}
