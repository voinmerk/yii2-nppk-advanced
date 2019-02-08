<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use common\models\User;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $slug
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property int $status
 * @property int $sort_order
 * @property int $on_home
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 */
class Category extends ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'meta_title'], 'required'],
            [['description', 'meta_description', 'meta_keywords'], 'string'],
            [['status', 'sort_order', 'on_home', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['title', 'slug', 'meta_title'], 'string', 'max' => 255],
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
            'id' => Yii::t('backend', 'ID'),
            'title' => Yii::t('backend', 'Title'),
            'description' => Yii::t('backend', 'Description'),
            'slug' => Yii::t('backend', 'Slug'),
            'meta_title' => Yii::t('backend', 'Meta Title'),
            'meta_description' => Yii::t('backend', 'Meta Description'),
            'meta_keywords' => Yii::t('backend', 'Meta Keywords'),
            'status' => Yii::t('backend', 'Status'),
            'sort_order' => Yii::t('backend', 'Sort Order'),
            'on_home' => Yii::t('backend', 'On Home'),
            'created_by' => Yii::t('backend', 'Created By'),
            'updated_by' => Yii::t('backend', 'Updated By'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
        ];
    }

    public static function getCategoryList()
    {
        return self::find()->where(['status' => self::STATUS_ACTIVE])->orderBy(['title' => SORT_ASC])->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * {@inheritdoc}
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
            self::STATUS_INACTIVE => Yii::t('backend', 'Unpublished'),
            self::STATUS_ACTIVE => Yii::t('backend', 'Published'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getStatusName()
    {
        $statusList = self::getStatusList();

        return $statusList[$this->status];
    }

    /**
     * {@inheritdoc}
     * @return CategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CategoryQuery(get_called_class());
    }
}
