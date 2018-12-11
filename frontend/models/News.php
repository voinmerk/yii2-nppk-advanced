<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%news}}".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $preview_content
 * @property string $image
 * @property string $slug
 * @property int $publsihed
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 */
class News extends \yii\db\ActiveRecord
{
    const UNPUBLISHED = 0;
    const PUBLISHED = 1;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%news}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'content', 'preview_content', 'image', 'slug'], 'required'],
            [['content', 'preview_content'], 'string'],
            [['publsihed', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['title', 'image', 'slug'], 'string', 'max' => 255],
            [['slug'], 'unique'],
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
            'content' => 'Content',
            'preview_content' => 'Preview Content',
            'image' => 'Image',
            'slug' => 'Slug',
            'publsihed' => 'Publsihed',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
