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
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'fixed', 'published', 'cut', 'created_by', 'updated_by', 'blog_menu_id', 'created_at', 'updated_at'], 'integer'],
            [['slug', 'template'], 'safe'],
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
        $language = (Language::getLanguageIdByCode(Yii::$app->language))['language_id'];

        $query = Blog::find()
                    ->select([
                        'blogs.*', 
                        'blogDesc.name AS name', 
                        'createdUser.username AS created_username', 
                        /*'blogMenuDesc.name AS menu_name', */
                    ])
                    ->joinWith([
                        'blogsDescriptions' => function($q) {
                            return $q->from(['blogDesc' => BlogDescription::tableName()])->where(['blogDesc.language_id' => $language]);
                        },
                        'createdBy' => function($q) {
                            return $q->from(['createdUser' => User::tableName()]);
                        },
                        /*'blogsMenuDescriptions' => function($q) {
                            return $q->from(['blogMenuDesc' => BlogMenuDescription::tableName()]);
                        },*/
                    ]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['updated_at' => SORT_DESC, 'created_at' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'published' => $this->published,
            // 'blog_menu_id' => $this->blog_menu_id,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'template', $this->template])
            ->andFilterWhere(['like', 'users.username', $this->created_by])
            /*->andFilterWhere(['like', 'blogsDescriptions.username', $this->blogsDescriptions->name])*/;

        return $dataProvider;
    }
}
