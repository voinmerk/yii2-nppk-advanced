<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

use backend\models\Post;

/**
 * PostSearch represents the model behind the search form about `backend\models\Post`.
 */
class PostSearch extends Post
{
    public $createdName;
    public $updatedName;
    public $categoryName;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'updated_by', 'image_id', 'created_at', 'updated_at'], 'integer'],
            [['title', 'content', 'meta_title', 'meta_keywords', 'meta_description', 'slug', 'status', 'createdName', 'updatedName', 'categoryName'], 'safe'],
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
                'content',
                'meta_title',
                'meta_keywords',
                'meta_description',
                'slug',
                'status',
                'image_id',
                'categoryName' => [
                    'asc' => ['{{%category}}.title' => SORT_ASC],
                    'desc' => ['{{%category}}.title' => SORT_DESC],
                ],
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

        $this->addCondition($query, '{{%post}}.id');
        $this->addCondition($query, '{{%post}}.title', true);
        $this->addCondition($query, '{{%post}}.content', true);
        $this->addCondition($query, '{{%post}}.meta_title', true);
        $this->addCondition($query, '{{%post}}.meta_keywords', true);
        $this->addCondition($query, '{{%post}}.meta_description', true);
        $this->addCondition($query, '{{%post}}.slug', true);
        $this->addCondition($query, '{{%post}}.status');
        $this->addCondition($query, '{{%post}}.image_id');
        $this->addCondition($query, '{{%post}}.created_by');
        $this->addCondition($query, '{{%post}}.updated_by');
        $this->addCondition($query, '{{%post}}.created_at');
        $this->addCondition($query, '{{%post}}.updated_at');

        $query->joinWith(['createdBy' => function ($q) {
            $q->from('{{%user}} createdUser')->where('createdUser.username LIKE "%' . $this->createdName . '%"');
        }]);

        $query->joinWith(['updatedBy' => function ($q) {
            $q->from('{{%user}} updatedUser')->where('updatedUser.username LIKE "%' . $this->updatedName . '%"');
        }]);

        $query->joinWith(['category' => function ($q) {
            $q->where('{{%category}}.title LIKE "%' . $this->categoryName . '%"');
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
