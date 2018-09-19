<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%images_description}}".
 *
 * @property int $image_id
 * @property int $language_id
 * @property string $name
 * @property string $description
 *
 * @property Images $image
 * @property Languages $language
 */
class ImageDescription extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%images_description}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image_id', 'language_id'], 'required'],
            [['image_id', 'language_id'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['image_id' => 'id']],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['language_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'image_id' => Yii::t('frontend', 'Image ID'),
            'language_id' => Yii::t('frontend', 'Language ID'),
            'name' => Yii::t('frontend', 'Name'),
            'description' => Yii::t('frontend', 'Description'),
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
    public function getLanguage()
    {
        return $this->hasOne(Language::className(), ['id' => 'language_id']);
    }
}
