<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User;

/**
 * UserSearch represents the model behind the search form of `common\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'user_group_id', 'user_permission_id', 'created_at', 'updated_at'], 'integer'],
            [['username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'first_name', 'last_name'], 'safe'],
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
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'updated_at' => SORT_DESC,
                ],
                'attributes' => [
                    'id',
                    'username',
                    'auth_key',
                    'password_hash',
                    'password_reset_token',
                    'email',
                    'first_name',
                    'last_name',
                    'status',
                    'user_group_id',
                    'user_permission_id',
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
        $this->addCondition($query, 'username', true);
        $this->addCondition($query, 'auth_key', true);
        $this->addCondition($query, 'password_hash', true);
        $this->addCondition($query, 'password_reset_token', true);
        $this->addCondition($query, 'email', true);
        $this->addCondition($query, 'first_name', true);
        $this->addCondition($query, 'last_name', true);
        $this->addCondition($query, 'status');
        $this->addCondition($query, 'user_group_id');
        $this->addCondition($query, 'user_permission_id');
        $this->addCondition($query, 'created_at');
        $this->addCondition($query, 'updated_at');

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

        $fullAttribute = $this->tableName() . '.' . $attribute;

        if ($partialMatch) {
            $query->andWhere(['like', $fullAttribute, $value]);
        } else {
            $query->andWhere([$fullAttribute => $value]);
        }
    }
}
