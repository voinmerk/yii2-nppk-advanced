<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%settings}}".
 *
 * @property int $id
 * @property int $language_id
 * @property int $multilanguage
 *
 * @property Languages $language
 */
class Setting extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%settings}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['language_id', 'multilanguage'], 'integer'],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['language_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('frontend', 'ID'),
            'language_id' => Yii::t('frontend', 'Language ID'),
            'multilanguage' => Yii::t('frontend', 'Multilanguage'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::className(), ['id' => 'language_id']);
    }
}
