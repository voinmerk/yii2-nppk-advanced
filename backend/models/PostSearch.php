<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Post;

/**
 * PostSearch represents the model behind the search form of `backend\models\Post`.
 */
class PostSearch extends Post
{
    public $categoryName;
    public $createdName;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'fixed', 'template', 'published', 'created_by', 'updated_by', 'category_id', 'created_at', 'updated_at'], 'integer'],
            [['title', 'content', 'slug', 'categoryName', 'createdName'], 'safe'],
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
        $query = Post::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['updated_at' => SORT_DESC]],
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'title',
                'content',
                'categoryName' => [
                    'asc' => ['{{%category}}.title' => SORT_ASC],
                    'desc' => ['{{%category}}.title' => SORT_DESC],
                    'label' => 'Category Name',
                ],
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
            $query->joinWith(['category']);
            $query->joinWith(['createdBy']);

            return $dataProvider;
        }

        $this->addCondition($query, '{{%post}}.title', true);
        $this->addCondition($query, '{{%post}}.content', true);
        $this->addCondition($query, '{{%post}}.category_id');
        $this->addCondition($query, '{{%post}}.created_by');
        $this->addCondition($query, '{{%post}}.published');
        $this->addCondition($query, '{{%post}}.updated_at');

        $query->joinWith(['category' => function ($q) {
            $q->where('{{%category}}.title LIKE "%' . $this->categoryName . '%"');
        }]);

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
