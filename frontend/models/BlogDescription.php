<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%blogs_description}}".
 *
 * @property int $blog_id
 * @property int $language_id
 * @property string $name
 * @property string $description
 *
 * @property Blogs $blog
 * @property Languages $language
 */
class BlogsDescription extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%blogs_description}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['blog_id', 'language_id'], 'required'],
            [['blog_id', 'language_id'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['blog_id'], 'exist', 'skipOnError' => true, 'targetClass' => Blog::className(), 'targetAttribute' => ['blog_id' => 'id']],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['language_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'blog_id' => Yii::t('frontend', 'Blog ID'),
            'language_id' => Yii::t('frontend', 'Language ID'),
            'name' => Yii::t('frontend', 'Name'),
            'description' => Yii::t('frontend', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlog()
    {
        return $this->hasOne(Blog::className(), ['id' => 'blog_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::className(), ['id' => 'language_id']);
    }
}
