<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%blogs_menu_description}}".
 *
 * @property int $blog_menu_id
 * @property int $language_id
 * @property string $name
 * @property string $description
 *
 * @property BlogsMenu $blogMenu
 * @property Languages $language
 */
class BlogMenuDescription extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%blogs_menu_description}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['blog_menu_id', 'language_id', 'name'], 'required'],
            [['blog_menu_id', 'language_id'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['blog_menu_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlogMenu::className(), 'targetAttribute' => ['blog_menu_id' => 'id']],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['language_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'blog_menu_id' => Yii::t('frontend', 'Blog Menu ID'),
            'language_id' => Yii::t('frontend', 'Language ID'),
            'name' => Yii::t('frontend', 'Name'),
            'description' => Yii::t('frontend', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogMenu()
    {
        return $this->hasOne(BlogMenu::className(), ['id' => 'blog_menu_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::className(), ['id' => 'language_id']);
    }
}
