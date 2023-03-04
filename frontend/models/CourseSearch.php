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
            [['globalSearch'], 'string']
        ]);
    }

    public function search($params): ActiveDataProvider
    {
        $query = Course::find();

        $this->load($params);

        $query->orFilterWhere(['LIKE', 'Course_ID', $this->globalSearch])
            ->orFilterWhere(['LIKE', 'Course_Name', $this->globalSearch]);
        $query->orderBy(['Course_ID' => 3]);

        return new ActiveDataProvider(['query' => $query]);
    }
}