<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%languages_phrase_value}}".
 *
 * @property int $phrase_id
 * @property int $language_id
 * @property string $value
 *
 * @property Languages $language
 * @property LanguagesPhrase $phrase
 */
class LanguagePhraseValue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%languages_phrase_value}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phrase_id', 'language_id', 'value'], 'required'],
            [['phrase_id', 'language_id'], 'integer'],
            [['value'], 'string'],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['language_id' => 'id']],
            [['phrase_id'], 'exist', 'skipOnError' => true, 'targetClass' => LanguagePhrase::className(), 'targetAttribute' => ['phrase_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'phrase_id' => Yii::t('frontend', 'Phrase ID'),
            'language_id' => Yii::t('frontend', 'Language ID'),
            'value' => Yii::t('frontend', 'Value'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::className(), ['id' => 'language_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhrase()
    {
        return $this->hasOne(LanguagePhrase::className(), ['id' => 'phrase_id']);
    }
}
