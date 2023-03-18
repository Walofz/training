<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * TrainnerSearch represents the model behind the search form of `frontend\models\Trainner`.
 */
class TrainerSearch extends Trainer
{
    public $globalSearch;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Trainner_ID', 'Trainner_Name', 'Trainner_Descrition', 'Trainner_From', 'User_Create', 'Date_Create'], 'safe'],
            [['globalSearch'], 'string']
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
    public function search($params): ActiveDataProvider
    {
        $query = Trainer::find();

        $this->load($params);

        $query->orFilterWhere(['LIKE', 'Trainner_ID', $this->globalSearch])
            ->orFilterWhere(['LIKE', 'Trainner_Name', $this->globalSearch]);
        $query->orderBy(['Trainner_ID' => 3]);

        return new ActiveDataProvider(['query' => $query]);
    }
}
