<?php

namespace frontend\models;

use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class CourseSearch extends Course
{
    public $globalSearch;

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['globalSearch'], 'safe']
        ]);
    }

    public function search($params): ActiveDataProvider
    {
        $query = Course::find();
        $dataProvider = new ActiveDataProvider(['query' => $query]);

        $this->load($params);

        $query->orFilterWhere(['LIKE', 'Course_ID', $this->globalSearch])
            ->orFilterWhere(['LIKE', 'Course_Name', $this->globalSearch]);

        $query->orderBy(['Course_ID', SORT_ASC]);

        return $dataProvider;
    }
}