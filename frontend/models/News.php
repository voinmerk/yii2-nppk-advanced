<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "news".
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
class News extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'content', 'meta_title', 'slug'], 'required'],
            [['content', 'meta_keywords', 'meta_description'], 'string'],
            [['status', 'image_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['title', 'meta_title', 'slug'], 'string', 'max' => 255],
            [['slug'], 'unique'],
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
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'meta_title' => 'Meta Title',
            'meta_keywords' => 'Meta Keywords',
            'meta_description' => 'Meta Description',
            'slug' => 'Slug',
            'status' => 'Status',
            'image_id' => 'Image ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
}
