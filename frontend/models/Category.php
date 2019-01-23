<?php
namespace frontend\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property int $status
 * @property int $sort_order
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property Post[] $posts
 */
class Category extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'slug', 'meta_title', 'created_at', 'updated_at'], 'required'],
            [['meta_description', 'meta_keywords'], 'string'],
            [['status', 'sort_order', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
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
            'id' => 'ID',
            'title' => 'Title',
            'slug' => 'Slug',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'status' => 'Status',
            'sort_order' => 'Sort Order',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
    public function getPost()
    {
        return $this->posts[0];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['id' => 'post_id'])->viaTable('category_to_post', ['category_id' => 'id'])->orderBy(['updated_at' => SORT_DESC]);
    }
}
