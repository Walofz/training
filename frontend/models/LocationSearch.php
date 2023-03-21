<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * LocationSearch represents the model behind the search form of `frontend\models\Location`.
 */
class LocationSearch extends Location
{
    /**
     * {@inheritdoc}
     */

    public $globalSearch;

    public function rules()
    {
        return [
            [['Location_ID', 'Location_Name', 'Location_Description', 'Location_Provice', 'Location_Tel', 'User_Create', 'Date_Create'], 'safe'],
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
    public function search(array $params): ActiveDataProvider
    {
        $query = Location::find();

        $this->load($params);

        $query->orFilterWhere(['LIKE', 'Location_ID', $this->globalSearch])
            ->orFilterWhere(['LIKE', 'Location_Name', $this->globalSearch])
            ->orFilterWhere(['LIKE', 'Location_Description', $this->globalSearch]);

        $query->orderBy(['Location_ID' => 3]);
        return new ActiveDataProvider(['query' => $query]);
    }
}
