<?php

namespace backend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "{{%teacher_group}}".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $sort_order
 * @property int $status
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Teacher[] $teachers
 * @property User $createdBy
 * @property User $updatedBy
 */
class TeacherGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%teacher_group}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'slug', 'created_at', 'updated_at'], 'required'],
            [['sort_order', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['name', 'slug'], 'string', 'max' => 255],
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
            'name' => Yii::t('backend', 'Name'),
            'slug' => Yii::t('backend', 'Slug'),
            'sort_order' => Yii::t('backend', 'Sort Order'),
            'status' => Yii::t('backend', 'Published'),
            'created_by' => Yii::t('backend', 'Created By'),
            'updated_by' => Yii::t('backend', 'Updated By'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),

            'statusName' => Yii::t('backend', 'Published'),
            'createdName' => Yii::t('backend', 'Created By'),
            'updatedName' => Yii::t('backend', 'Updated By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeachers()
    {
        return $this->hasMany(Teacher::className(), ['teacher_group_id' => 'id']);
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
}
