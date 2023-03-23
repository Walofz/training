<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * TrainingSearch represents the model behind the search form of `frontend\models\Training`.
 */
class TrainingSearch extends Training
{

    public $globalSearch;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Train_Detail_ID', 'User_Total'], 'integer'],
            [['Course_ID', 'Trainer_ID', 'Location_ID', 'Start_Train_Date', 'End_Train_Date', 'User_Create', 'Date_Create'], 'safe'],
            [['Course_Cost'], 'number'],
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
    public function search($params)
    {
        $query = Training::find();

        $this->load($params);

        $query->orFilterWhere(['LIKE', 'Course_ID', $this->globalSearch])
            ->orFilterWhere(['LIKE', 'Trainer_ID', $this->globalSearch])
            ->orFilterWhere(['LIKE', 'Location_ID', $this->globalSearch]);

        $query->limit(60);
        $query->orderBy(['Train_Detail_ID' => 3]);

        return new ActiveDataProvider(['query' => $query]);
    }
}
