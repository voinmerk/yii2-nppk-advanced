<?php

namespace common\models;

use Yii;

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
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

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
    public function behaviors()
    {
        return [
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
            'id' => Yii::t('common', 'ID'),
            'name' => Yii::t('common', 'Name'),
            'slug' => Yii::t('common', 'Slug'),
            'sort_order' => Yii::t('common', 'Sort Order'),
            'status' => Yii::t('common', 'Published'),
            'created_by' => Yii::t('common', 'Created By'),
            'updated_by' => Yii::t('common', 'Updated By'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),

            'createdName' => Yii::t('common', 'Created Name'),
            'updatedName' => Yii::t('common', 'Updated Name'),
            'statusName' => Yii::t('common', 'Published'),
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
            self::STATUS_INACTIVE => Yii::t('common', 'Unpublished'),
            self::STATUS_ACTIVE => Yii::t('common', 'Published'),
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
     * @return \common\models\query\TeacherGroupQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TeacherGroupQuery(get_called_class());
    }
}
