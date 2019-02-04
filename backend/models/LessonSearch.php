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
    public $updatedName;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['name', 'createdName', 'updatedName'], 'safe'],
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
            'sort' => [
                'defaultOrder' => [
                    'updated_at' => SORT_DESC,
                ],
            ],
            'pagination' => [
                'pageSize' => 40,
            ],
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'name',
                'status',
                'createdName' => [
                    'asc' => ['{{%user}}.username' => SORT_ASC],
                    'desc' => ['{{%user}}.username' => SORT_DESC],
                ],
                'updatedName' => [
                    'asc' => ['{{%user}}.username' => SORT_ASC],
                    'desc' => ['{{%user}}.username' => SORT_DESC],
                ],
                'created_by',
                'updated_by',
                'created_at',
                'updated_at',
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $this->addCondition($query, '{{%lesson}}.name', true);
        $this->addCondition($query, '{{%lesson}}.status');
        $this->addCondition($query, '{{%lesson}}.created_by');
        $this->addCondition($query, '{{%lesson}}.updated_by');
        $this->addCondition($query, '{{%lesson}}.created_at');
        $this->addCondition($query, '{{%lesson}}.updated_at');

        $query->joinWith(['createdBy' => function ($q) {
            $q->from('{{%user}} createdUser')->where('createdUser.username LIKE "%' . $this->createdName . '%"');
        }]);

        $query->joinWith(['updatedBy' => function ($q) {
            $q->from('{{%user}} updatedUser')->where('updatedUser.username LIKE "%' . $this->updatedName . '%"');
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
