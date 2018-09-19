<?php

namespace backend\models;

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
    public function behaveriors()
    {
        return [
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
            'parent_id' => Yii::t('backend', 'Parent ID'),
            'slug' => Yii::t('backend', 'Slug'),
            'published' => Yii::t('backend', 'Published'),
            'sort_order' => Yii::t('backend', 'Sort Order'),
            'created_by' => Yii::t('backend', 'Created By'),
            'updated_by' => Yii::t('backend', 'Updated By'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
        ];
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
}
