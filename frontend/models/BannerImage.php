<?php

namespace frontend\models;

use Yii;

use common\models\User;

/**
 * This is the model class for table "{{%banners_image}}".
 *
 * @property int $id
 * @property int $sort_order
 * @property int $published
 * @property int $created_by
 * @property int $updated_by
 * @property int $image_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Images $image
 * @property Users $createdBy
 * @property Users $updatedBy
 */
class BannerImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%banners_image}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sort_order', 'published', 'created_by', 'updated_by', 'image_id', 'created_at', 'updated_at'], 'integer'],
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
            'created_by' => Yii::t('frontend', 'Created By'),
            'updated_by' => Yii::t('frontend', 'Updated By'),
            'image_id' => Yii::t('frontend', 'Image ID'),
            'created_at' => Yii::t('frontend', 'Created At'),
            'updated_at' => Yii::t('frontend', 'Updated At'),
        ];
    }

    public function getImages()
    {
        $sql = "SELECT bi.*, i.src AS src, id.name AS name, id.description AS description FROM banners_image bi 
                LEFT JOIN images i ON (bi.image_id = i.image_id) 
                LEFT JOIN images_description id ON (i.image_id = id.image_id) 
                WHERE bi.published = 1 AND id.language_id = {$language['language_id']} ORDER BY bi.sort_id ASC, bi.date_added DESC";

        return $this->find()->where(['published' => 1])->with('image')->asArray()->all();
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
