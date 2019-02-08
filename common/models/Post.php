<?php

namespace common\models;

use Yii;

/**
* This is the model class for table "{{%post}}".
*
  * @property integer $id
  * @property string $title
  * @property string $content
  * @property string $meta_title
  * @property string $meta_keywords
  * @property string $meta_description
  * @property string $slug
  * @property integer $status
  * @property integer $created_by
  * @property integer $updated_by
  * @property integer $category_id
  * @property integer $image_id
  * @property integer $created_at
  * @property integer $updated_at
  *
      * @property Image $image
      * @property User $createdBy
      * @property User $updatedBy
  */
class Post extends \yii\db\ActiveRecord
{


  /**
  * @inheritdoc
  */
  public static function tableName()
  {
    return '{{%post}}';
  }

  /**
  * @inheritdoc
  */
  public function behaviors()
  {
    return [
          ];
  }

  /**
  * @inheritdoc
  */
  public function rules()
  {
    return [
            [['title', 'content', 'meta_title', 'slug', 'created_at', 'updated_at'], 'required'],
            [['content', 'meta_keywords', 'meta_description'], 'string'],
            [['created_by', 'updated_by', 'category_id', 'image_id', 'created_at', 'updated_at'], 'integer'],
            [['title', 'meta_title', 'slug'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 1],
            [['slug'], 'unique']
        ];
  }

  /**
  * @inheritdoc
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
        'created_by' => Yii::t('backend', 'Created By'),
        'updated_by' => Yii::t('backend', 'Updated By'),
        'category_id' => Yii::t('backend', 'Category ID'),
        'image_id' => Yii::t('backend', 'Image ID'),
        'created_at' => Yii::t('backend', 'Created At'),
        'updated_at' => Yii::t('backend', 'Updated At'),
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
  
  /**
  * @inheritdoc
  * @return PostQuery the active query used by this AR class.
  */
  public static function find()
  {
  return new PostQuery(get_called_class());
  }
}
