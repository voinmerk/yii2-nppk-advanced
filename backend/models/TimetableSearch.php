<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Timetable;

/**
 * TimetableSearch represents the model behind the search form of `backend\models\Timetable`.
 */
class TimetableSearch extends Timetable
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'group_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['date'], 'safe'],
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

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['updated_at' => SORT_DESC]],
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'groupName' => [
                    'asc' => ['group.name' => SORT_ASC],
                    'desc' => ['group.name' => SORT_DESC],
                    'label' => 'Group Name',
                ],
                'createdName' => [
                    'asc' => ['users.username' => SORT_ASC],
                    'desc' => ['users.username' => SORT_DESC],
                    'label' => 'Created Name',
                ],
                'date',
                'published',
                'updated_at',
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            $query->joinWith(['group']);
            $query->joinWith(['createdBy']);

            return $dataProvider;
        }

        $this->addCondition($query, 'groups.name', true);
        $this->addCondition($query, 'groups.name', true);
        $this->addCondition($query, 'timetables.group_id');
        $this->addCondition($query, 'timetables.date');
        $this->addCondition($query, 'timetables.created_by');
        $this->addCondition($query, 'timetables.published');
        $this->addCondition($query, 'timetables.updated_at');

        $query->joinWith(['group' => function ($q) {
            $q->where('group.name LIKE "%' . $this->groupName . '%"');
        }]);

        $query->joinWith(['createdBy' => function ($q) {
            $q->where('users.username LIKE "%' . $this->createdName . '%"');
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
