<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Blog;

use common\models\User;

/**
 * BlogSearch represents the model behind the search form of `backend\models\Blog`.
 */
class BlogSearch extends Blog
{
    public $name;
    public $description;
    public $createdName;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'fixed', 'published', 'cut', 'created_by', 'updated_by', 'blog_menu_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'description', 'createdName', 'slug', 'template'], 'safe'],
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
        // $language = Language::getLanguageIdByCode(Yii::$app->language)->id;

        $query = Blog::find();

        $query->select([
                    'blogs.*',
                    'blogs_description.name AS name',
                    'blogs_description.description AS description',
                ]);

        $query->joinWith(['blogsDescriptions' => function($q) {
            $q->select([
                'blogs_description.name AS name',
                'blogs_description.description AS description',
            ]);
            $q->where('blogs_description.language_id = 1');
        }]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['updated_at' => SORT_DESC]],
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'name' => [
                    'asc' => ['blogs_description.name' => SORT_ASC],
                    'desc' => ['blogs_description.name' => SORT_DESC],
                    'label' => 'Name',
                ],
                'description' => [
                    'asc' => ['blogs_description.description' => SORT_ASC],
                    'desc' => ['blogs_description.description' => SORT_DESC],
                    'label' => 'Description',
                ],
                'createdName' => [
                    'asc' => ['users.username' => SORT_ASC],
                    'desc' => ['users.username' => SORT_DESC],
                    'label' => 'Created Name',
                ],
                'published',
                'updated_at',
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            $query->joinWith(['createdBy']);
            $query->joinWith(['blogsDescriptions' => function($q) {
                $q->where('blogs_description.language_id = 1');
            }]);

            return $dataProvider;
        }

        $this->addCondition($query, 'blogs_description.name', true);
        $this->addCondition($query, 'blogs_description.description', true);
        $this->addCondition($query, 'blogs.created_by');
        $this->addCondition($query, 'blogs.published');
        $this->addCondition($query, 'blogs.updated_at');

        $query->joinWith(['createdBy' => function ($q) {
            $q->where('users.username LIKE "%' . $this->createdName . '%"');
        }]);

        $query->joinWith(['blogsDescriptions' => function ($q) {
            $q->where('blogs_description.name LIKE "%' . $this->name . '%"');
            $q->andWhere('blogs_description.language_id = 1');
        }]);

        $query->joinWith(['blogsDescriptions' => function ($q) {
            $q->where('blogs_description.description LIKE "%' . $this->description . '%"');
            $q->andWhere('blogs_description.language_id = 1');
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
