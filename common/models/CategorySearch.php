<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Category;

/**
 * CategorySearch represents the model behind the search form of `common\models\Category`.
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

        $query->joinWith([
            'createdBy' => function ($q) {
               $q->from('{{%user}} createdUser');
            },
            'updatedBy' => function ($q) {
               $q->from('{{%user}} updatedUser');
            },
        ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'updated_at' => SORT_DESC,
                ],
                'attributes' => [
                    'id',
                    'title',
                    'description',
                    'slug',
                    'meta_title',
                    'meta_description',
                    'meta_keywords',
                    'status',
                    'sort_order',
                    'on_home',
                    'createdName' => [
                        'asc' => ['createdUser.username' => SORT_ASC],
                        'desc' => ['createdUser.username' => SORT_DESC],
                    ],
                    'updatedName' => [
                        'asc' => ['updatedUser.username' => SORT_ASC],
                        'desc' => ['updatedUser.username' => SORT_DESC],
                    ],
                    'created_by',
                    'updated_by',
                    'created_at',
                    'updated_at',
                ],
            ],
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $this->addCondition($query, 'id');
        $this->addCondition($query, 'title', true);
        $this->addCondition($query, 'description', true);
        $this->addCondition($query, 'slug', true);
        $this->addCondition($query, 'meta_title', true);
        $this->addCondition($query, 'meta_description', true);
        $this->addCondition($query, 'meta_keywords', true);
        $this->addCondition($query, 'status');
        $this->addCondition($query, 'sort_order');
        $this->addCondition($query, 'on_home');
        $this->addCondition($query, 'created_by');
        $this->addCondition($query, 'updated_by');
        $this->addCondition($query, 'created_at');
        $this->addCondition($query, 'updated_at');

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

        $fullAttribute = $this->tableName() . '.' . $attribute;

        if ($partialMatch) {
            $query->andWhere(['like', $fullAttribute, $value]);
        } else {
            $query->andWhere([$fullAttribute => $value]);
        }
    }
}
