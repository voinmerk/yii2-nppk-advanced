<?php

namespace frontend\models;

use Yii;

use common\models\User;

/**
 * This is the model class for table "{{%blogs_menu}}".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $slug
 * @property int $published
 * @property int $sort_order
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Blogs[] $blogs
 * @property Users $createdBy
 * @property Users $updatedBy
 * @property BlogsMenuDescription[] $blogsMenuDescriptions
 */
class BlogMenu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%blogs_menu}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'published', 'sort_order', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['slug', 'created_at', 'updated_at'], 'required'],
            [['slug'], 'string', 'max' => 255],
            [['slug'], 'unique'],
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
            'parent_id' => Yii::t('frontend', 'Parent ID'),
            'slug' => Yii::t('frontend', 'Slug'),
            'published' => Yii::t('frontend', 'Published'),
            'sort_order' => Yii::t('frontend', 'Sort Order'),
            'created_by' => Yii::t('frontend', 'Created By'),
            'updated_by' => Yii::t('frontend', 'Updated By'),
            'created_at' => Yii::t('frontend', 'Created At'),
            'updated_at' => Yii::t('frontend', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function getMenuById($id) {
        return self::find()
                    ->select(['blogs_menu.*', 'blogs_menu_description.name AS name'])
                    ->leftJoin('blogs_menu_description', 'blogs_menu_description.blog_menu_id = blogs_menu.id')
                    ->where([
                        'blogs_menu.published' => 1,
                        'blogs_menu.slug' => $id,
                        'blogs_menu_description.language_id' => Language::getLanguageIdByCode(Yii::$app->language)
                    ])
                    ->asArray()
                    ->one();
    }

    /**
     * {@inheritdoc}
     */
    public static function getMenu() {
        return self::find()
                    ->select(['blogs_menu.*', 'blogs_menu_description.name AS name', 'blogs_menu_description.description AS description'])
                    ->leftJoin('blogs_menu_description', 'blogs_menu_description.blog_menu_id = blogs_menu.id')
                    ->where([
                        'blogs_menu.published' => 1,
                        'blogs_menu_description.language_id' => Language::getLanguageIdByCode(Yii::$app->language),
                    ])
                    ->asArray()
                    ->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogs()
    {
        return $this->hasMany(Blog::className(), ['blog_menu_id' => 'id']);
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
    public function getBlogsMenuDescriptions()
    {
        return $this->hasMany(BlogMenuDescription::className(), ['blog_menu_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getName()
    {
        $languageId = Language::getLanguageIdByCode(Yii::$app->language)->id;

        return $this->hasOne(BlogMenuDescription::className(), ['blog_menu_id' => 'id'])->andWhere(['blogs_menu_description.language_id' => $languageId]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDescription()
    {
        $languageId = Language::getLanguageIdByCode(Yii::$app->language)->id;

        return $this->hasOne(BlogMenuDescription::className(), ['blog_menu_id' => 'id'])->andWhere(['blogs_menu_description.language_id' => $languageId]);
    }
}
