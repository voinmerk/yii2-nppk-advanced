<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Timetable;

/**
 * TimetableSearch represents the model behind the search form of `common\models\Timetable`.
 */
class TimetableSearch extends Timetable
{
    public $createdName;
    public $updatedName;
    public $groupName;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'group_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['date', 'createdName', 'updatedName', 'groupName'], 'safe'],
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
        $query = Timetable::find();

        $query->joinWith([
            'group',
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
                    'date',
                    'group_id',
                    'groupName' => [
                        'asc' => ['{{%group}}.name' => SORT_ASC],
                        'desc' => ['{{%group}}.name' => SORT_DESC],
                    ],
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
        $this->addCondition($query, 'date', true);
        $this->addCondition($query, 'group_id');
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

        $query->joinWith(['group' => function ($q) {
            $q->where('{{%group}}.name LIKE "%' . $this->groupName . '%"');
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
