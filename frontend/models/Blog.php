<?php

namespace frontend\models;

use Yii;

use common\models\User;

/**
 * This is the model class for table "{{%blogs}}".
 *
 * @property int $id
 * @property int $fixed
 * @property string $slug
 * @property string $template
 * @property int $published
 * @property int $cut
 * @property int $created_by
 * @property int $updated_by
 * @property int $blog_menu_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property BlogsMenu $blogMenu
 * @property Users $createdBy
 * @property Users $updatedBy
 * @property BlogsDescription[] $blogsDescriptions
 */
class Blog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%blogs}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fixed', 'published', 'cut', 'created_by', 'updated_by', 'blog_menu_id', 'created_at', 'updated_at'], 'integer'],
            [['slug', 'template', 'created_at', 'updated_at'], 'required'],
            [['slug', 'template'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            [['blog_menu_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlogMenu::className(), 'targetAttribute' => ['blog_menu_id' => 'id']],
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
            'fixed' => Yii::t('frontend', 'Fixed'),
            'slug' => Yii::t('frontend', 'Slug'),
            'template' => Yii::t('frontend', 'Template'),
            'published' => Yii::t('frontend', 'Published'),
            'cut' => Yii::t('frontend', 'Cut'),
            'created_by' => Yii::t('frontend', 'Created By'),
            'updated_by' => Yii::t('frontend', 'Updated By'),
            'blog_menu_id' => Yii::t('frontend', 'Blog Menu ID'),
            'created_at' => Yii::t('frontend', 'Created At'),
            'updated_at' => Yii::t('frontend', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function getBlog($id)
    {
        return self::find()
                    ->select(['blogs.*', 'blogs_description.name AS name', 'blogs_description.description AS description', 'blogs_menu.slug AS slug', 'users.username AS username'])
                    ->leftJoin('blogs_description', 'blogs_description.blog_id = blogs.id')
                    ->leftJoin('users', 'users.id = blogs.created_by')
                    ->leftJoin('blogs_menu', 'blogs.blog_menu_id = blogs_menu.id')
                    ->where([
                        'blogs_description.language_id' => Language::getLanguageIdByCode(Yii::$app->language), 
                        'blogs.published' => 1, 
                        'blogs_menu.slug' => $id
                    ])
                    ->orderBy(['fixed' => SORT_DESC, 'created_at' => SORT_DESC])
                    ->asArray()
                    ->all();
    }

    /**
     * {@inheritdoc}
     */
    public static function getBlogBeta($id)
    {
        $query = self::find();

        $query->select([
            'blogs.*',
            'blogs_description.name AS name',
            'blogs_description.description AS description',
            'blogs_menu.slug AS slug',
            'users.username AS username'
        ])
        ->joinWith([
            'blogMenu', /*=> function($q) {
                return $q->where();
            },*/
            'blogsDescriptions',
            'createdBy'
        ])
        ->leftJoin('blogs_description', 'blogs_description.blog_id = blogs.id')
        ->leftJoin('users', 'users.id = blogs.created_by')
        ->leftJoin('blogs_menu', 'blogs.blog_menu_id = blogs_menu.id')
        ->where([
            'blogs_description.language_id' => Language::getLanguageIdByCode(Yii::$app->language), 
            'blogs.published' => 1, 
            'blogs_menu.slug' => $id
        ])
        ->orderBy(['blogs.fixed' => SORT_DESC, 'blogs.created_at' => SORT_DESC])
        ->all();

        return $query;
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
    public function getBlogsDescriptions()
    {
        return $this->hasMany(BlogDescription::className(), ['blog_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getName() {
        return $this->blogsDescriptions[0]->name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDescription() {
        return $this->blogsDescriptions[0]->description;
    }

    /**
     * {@inheritdoc}
     */
    public static function getTemplateList()
    {
        return ['news', 'page'];
    }

    /**
     * {@inheritdoc}
     */
    public function getTemplateName()
    {
        $templates = $this->getTemplateList();

        return $templates[$this->template];
    }
}
