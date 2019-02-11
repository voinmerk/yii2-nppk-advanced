<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Category;

/**
 * CategorySearch represents the model behind the search form of `backend\models\Category`.
 */
class CategorySearch extends Category
{
    public $createdName;
    public $updatedName;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'sort_order', 'on_home', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['title', 'description', 'slug', 'meta_title', 'meta_description', 'meta_keywords', 'createdName', 'updatedName'], 'safe'],
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
        $query = Category::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'updated_at' => SORT_DESC,
                ],
            ],
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'id',
                'title',
                'description',
                'meta_title',
                'meta_keywords',
                'meta_description',
                'slug',
                'status',
                'on_home',
                'createdName' => [
                    'asc' => ['{{%user}}.username' => SORT_ASC],
                    'desc' => ['{{%user}}.username' => SORT_DESC],
                ],
                'updatedName' => [
                    'asc' => ['{{%user}}.username' => SORT_ASC],
                    'desc' => ['{{%user}}.username' => SORT_DESC],
                ],
                'sort_order',
                'created_by',
                'updated_by',
                'created_at',
                'updated_at',
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $this->addCondition($query, '{{%category}}.id');
        $this->addCondition($query, '{{%category}}.title', true);
        $this->addCondition($query, '{{%category}}.description', true);
        $this->addCondition($query, '{{%category}}.meta_title', true);
        $this->addCondition($query, '{{%category}}.meta_keywords', true);
        $this->addCondition($query, '{{%category}}.meta_description', true);
        $this->addCondition($query, '{{%category}}.slug', true);
        $this->addCondition($query, '{{%category}}.status');
        $this->addCondition($query, '{{%category}}.sort_order');
        $this->addCondition($query, '{{%category}}.on_home');
        $this->addCondition($query, '{{%category}}.created_by');
        $this->addCondition($query, '{{%category}}.updated_by');
        $this->addCondition($query, '{{%category}}.created_at');
        $this->addCondition($query, '{{%category}}.updated_at');

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
