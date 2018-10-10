<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Lesson;

/**
 * LessonSearch represents the model behind the search form of `backend\models\Lesson`.
 */
class LessonSearch extends Lesson
{
    public $createdName;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'published', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['name', 'createdName'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Lesson::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['updated_at' => SORT_DESC]],
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'name',
                'createdName' => [
                    'asc' => ['{{%user}}.username' => SORT_ASC],
                    'desc' => ['{{%user}}.username' => SORT_DESC],
                    'label' => 'Created Name',
                ],
                'published',
                'updated_at',
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            $query->joinWith(['createdBy']);

            return $dataProvider;
        }

        $this->addCondition($query, '{{%lesson}}.name', true);
        $this->addCondition($query, '{{%lesson}}.created_by');
        $this->addCondition($query, '{{%lesson}}.published');
        $this->addCondition($query, '{{%lesson}}.updated_at');

        $query->joinWith(['createdBy' => function ($q) {
            $q->where('{{%user}}.username LIKE "%' . $this->createdName . '%"');
        }]);

        return $dataProvider;
    }

    protected function addCondition($query, $attribute, $partialMatch = false)
    {
        if (($pos = strrpos($attribute, '.')) !== false) {
            $modelAttribute = substr($attribute, $pos + 1);
        } else {
            $modelAttribute = $attribute;
        }

        $value = $this->$modelAttribute;
        if (trim($value) === '') {
            return;
        }

        /*
         * Для корректной работы фильтра со связью со
         * свой же моделью делаем:
         */

        if ($partialMatch) {
            $query->andWhere(['like', $attribute, $value]);
        } else {
            $query->andWhere([$attribute => $value]);
        }
    }
}
