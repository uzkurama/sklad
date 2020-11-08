<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Client;

/**
 * ClientSearch represents the model behind the search form of `app\models\Client`.
 */
class ClientSearch extends Client
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'passport_number', 'created_at', 'updated_at'], 'integer'],
            [['first_name', 'last_name', 'middle_name', 'phone', 'type', 'tin', 'checking_acc', 'mfo', 'org_name', 'passport_serial', 'status', 'comments'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Client::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'passport_number' => $this->passport_number,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'middle_name', $this->middle_name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'tin', $this->tin])
            ->andFilterWhere(['like', 'checking_acc', $this->checking_acc])
            ->andFilterWhere(['like', 'mfo', $this->mfo])
            ->andFilterWhere(['like', 'org_name', $this->org_name])
            ->andFilterWhere(['like', 'passport_serial', $this->passport_serial])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'comments', $this->comments]);

        return $dataProvider;
    }
}
