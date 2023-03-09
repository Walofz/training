<?php

namespace frontend\models;

use common\models\CourseTb;
use common\models\Document;
use common\models\TrainTypeTb;

class Course extends CourseTb
{

    public static function getDocument(): array
    {
        $model = Document::find()->where(['document_type_id' => [1, 2, 3, 4, 5, 6, 7]])->all();
        $tmp = [];
        $tmp[] = ['id' => '-', 'txt' => '-'];
        foreach ($model as $item) {
            $tmp[] = ['id' => $item->document_code, 'txt' => "{$item->document_code} | {$item->document_name}"];
        }

        return $tmp;
    }

    public static function getType(): array
    {
        $model = TrainTypeTb::find()->all();
        $tmp = [];
        $tmp[] = ['id' => 0, 'txt' => '-'];
        foreach ($model as $item) {
            $tmp[] = ['id' => $item->Train_Type_ID, 'txt' => $item->Train_Type_Name_TH];
        }

        return $tmp;
    }
}