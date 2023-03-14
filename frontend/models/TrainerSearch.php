<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * TrainnerSearch represents the model behind the search form of `frontend\models\Trainner`.
 */
class TrainerSearch extends Trainer
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Trainner_ID', 'Trainner_Name', 'Trainner_Descrition', 'Trainner_From', 'User_Create', 'Date_Create'], 'safe'],
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
        $query = Trainer::find();

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
            'Date_Create' => $this->Date_Create,
        ]);

        $query->andFilterWhere(['like', 'Trainner_ID', $this->Trainner_ID])
            ->andFilterWhere(['like', 'Trainner_Name', $this->Trainner_Name])
            ->andFilterWhere(['like', 'Trainner_Descrition', $this->Trainner_Descrition])
            ->andFilterWhere(['like', 'Trainner_From', $this->Trainner_From])
            ->andFilterWhere(['like', 'User_Create', $this->User_Create]);

        return $dataProvider;
    }
}
