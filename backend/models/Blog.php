<?php

namespace backend\models;

use Yii;

use common\models\User;

/**
 * This is the model class for table "{{%blogs}}".
 *
 * @property int $id
 * @property int $fixed
 * @property string $slug
 * @property int $template
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
            [['fixed', 'published', 'cut', 'created_by', 'updated_by', 'blog_menu_id', 'created_at', 'updated_at', 'template'], 'integer'],
            [['slug', 'name', 'description', 'blog_menu_id', 'template', 'created_at', 'updated_at'], 'required'],
            [['description'], 'string'],
            [['slug', 'name'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            [['blog_menu_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlogMenu::className(), 'targetAttribute' => ['blog_menu_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        $defaultLanguage = Language::getDefault(); // default language (all attributes)
        $languages = Language::getList(); // as array map (locale => name)

        return [
            'multilang' => [
                'class' => \omgdef\multilingual\MultilingualBehavior::className(),
                'languages' => $languages,
                'languageField' => 'language_id',
                //'localizedPrefix' => '',
                //'requireTranslations' => false',
                //'dynamicLangClass' => true',
                'langClassName' => BlogDescription::className(), // or namespace/for/a/class/PostLang
                'defaultLanguage' => $defaultLanguage->id,
                'langForeignKey' => 'blog_id',
                'tableName' => BlogDescription::tableName(),
                'attributes' => [
                    'name', 'description',
                ],
            ],
            'blame' => [
                'class' => \yii\behaviors\BlameableBehavior::className(),
            ],
            'timestamp' => [
                'class' => \yii\behaviors\TimestampBehavior::className(),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'fixed' => Yii::t('backend', 'Fixed'),
            'slug' => Yii::t('backend', 'Slug'),
            'template' => Yii::t('backend', 'Template'),
            'published' => Yii::t('backend', 'Published'),
            'cut' => Yii::t('backend', 'Cut'),
            'created_by' => Yii::t('backend', 'Created By'),
            'updated_by' => Yii::t('backend', 'Updated By'),
            'blog_menu_id' => Yii::t('backend', 'Blog Menu ID'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),

            'name' => Yii::t('backend', 'Name'),
            'description' => Yii::t('backend', 'Description'),
            'createdName' => Yii::t('backend', 'Created Name'),
            'updatedName' => Yii::t('backend', 'Updated Name'),
            'blogMenuName' => Yii::t('backend', 'Blog Menu ID'),
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
    public function getBlogMenuName()
    {
        return $this->blogMenu->blogsMenuDescriptions[0]->name;
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
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedName()
    {
        return $this->updatedBy->username;
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
    public static function getStatusList()
    {
        return [
            Yii::t('backend', 'unpublished'),
            Yii::t('backend', 'published'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getStatusName()
    {
        $status = $this->getStatusList();

        return $status[$this->published];
    }

    /**
     * {@inheritdoc}
     */
    public static function getTemplateList()
    {
        return [
            Yii::t('backend', 'News'),
            Yii::t('backend', 'Page'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getTemplateName()
    {
        $templates = $this->getTemplateList();

        return $templates[$this->template];
    }

    /**
     * {@inheritdoc}
     */
    public static function find()
    {
        return new MultilingualQuery(get_called_class());
    }
}
