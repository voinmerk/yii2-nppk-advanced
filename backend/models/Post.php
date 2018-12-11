<?php

namespace backend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "{{%post}}".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int $fixed
 * @property string $slug
 * @property int $template
 * @property int $published
 * @property int $created_by
 * @property int $updated_by
 * @property int $category_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Category $category
 * @property User $createdBy
 * @property User $updatedBy
 */
class Post extends \yii\db\ActiveRecord
{
    const UNPUBLISHED = 0;
    const PUBLISHED = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%post}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['content'], 'string'],
            [['fixed', 'template', 'published', 'created_by', 'updated_by', 'category_id', 'created_at', 'updated_at'], 'integer'],
            [['title', 'slug'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
     public function behaviors()
    {
        return [
            'sluggable' => [
                'class' => \yii\behaviors\SluggableBehavior::className(),
                'attribute' => 'title',
                'slugAttribute' => 'slug',
                'ensureUnique' => true,
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
            'title' => Yii::t('backend', 'Title'),
            'content' => Yii::t('backend', 'Content'),
            'fixed' => Yii::t('backend', 'Fixed'),
            'slug' => Yii::t('backend', 'SEO url'),
            'template' => Yii::t('backend', 'Шаблон'),
            'published' => Yii::t('backend', 'Published'),
            'created_by' => Yii::t('backend', 'Created By'),
            'updated_by' => Yii::t('backend', 'Updated By'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
            'category_id' => Yii::t('backend', 'Category'),

            'statusName' => 'Публикация',
            'fixedName' => 'Фиксирование записи',
            'templateName' => 'Шаблон',
            'categoryName' => 'Категория',
            'createdName' => 'Автор',
            'updatedName' => 'Модератор',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return Category::find()->where(['published' => Category::PUBLISHED])->all();
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
     * {@inheritdoc}
     */
    public function getCategoryList()
    {
        $categoryList = \yii\helpers\ArrayHelper::map($this->categories, 'id', 'title');

        return $categoryList;
    }

    /**
     * {@inheritdoc}
     */
    public function getCategoryName()
    {
        return $this->category->title;
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedName()
    {
        return $this->createdBy->username;
    }

    /**
     * {@inheritdoc}
     */
    public function getUpdatedName()
    {
        return $this->updatedBy->username;
    }

    /**
     * {@inheritdoc}
     */
    public static function getStatusList()
    {
        return [
            'Не опубликовано',
            'Опубликовано',
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
            'Новость',
            'Страница сайта',
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
    public function getFixedList()
    {
        return [
            'Не фиксирован',
            'Фиксирован',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getFixedName()
    {
        $fixeds = $this->getFixedList();

        return $fixeds[$this->fixed];
    }
}
