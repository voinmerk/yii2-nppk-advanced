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
            [['slug', 'blog_menu_id', 'template', 'created_at', 'updated_at'], 'required'],
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
    public function behaveriors()
    {
        return [
            /*'multilang' => [
                'class' => \omgdef\multilingual\MultilingualBehavior::className(),
                'languages' => [
                    'ru-RU' => 'Русский',
                    'en-US' => 'English',
                ],
                'languageField' => 'language_id',
                //'localizedPrefix' => '',
                //'requireTranslations' => false',
                //'dynamicLangClass' => true',
                'langClassName' => BlogDescription::className(), // or namespace/for/a/class/PostLang
                'defaultLanguage' => 'ru-RU',
                'langForeignKey' => 'blog_id',
                'tableName' => "{{%blogs_description}}",
                'attributes' => [
                    'name', 'description',
                ]
            ],*/
            'blame' => [
                'class' => \yii\behaveriors\BlameableBehavior::className(),
            ],
            'timestamp' => [
                'class' => \yii\behaveriors\TimestampBehavior::className(),
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
     * {@inheritdoc}
     */
    public function getFieldName($id)
    {
        $query = $this->find()
                    ->from(['b' => $this->tableName()])
                    ->select(['blogDesc.name AS name'])
                    ->joinWith([
                        'blogsDescriptions' => function($query) {
                            return $query->from(['blogDesc' => BlogDescription::tableName()]);
                        },
                    ])
                    ->where(['id' => $id, 'blogDesc.language_id' => Language::getLanguageIdByCode(Yii::$app->language)])
                    ->one();

        return $query->name;
    }

    /**
     * {@inheritdoc}
     */
    public static function getStatusList()
    {
        return [
            Yii::t('backend', 'published'),
            Yii::t('backend', 'unpublished'),
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
}
