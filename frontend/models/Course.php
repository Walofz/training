<?php

namespace frontend\models;

use common\models\CourseTb;
use common\models\Document;
use common\models\TrainTypeTb;

/**
 *
 * @property-read mixed $newID
 */
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

    public static function getCourse(): array
    {
        $model = self::find()->all();
        $tmp = [];
        foreach ($model as $item) {
            $tmp[] = ['id' => $item->Course_ID, 'txt' => $item->Course_Name];
        }
        return $tmp;
    }

    public function getNewID(): string
    {
        $model = self::find()->max('Course_ID');
        $prefix = substr($model, 0, 2) ?? "CO";
        $subfix = (int)substr($model, 2, strlen($model)) ?? 1;
        if ($prefix != null && $subfix != null) {
            $subfix = sprintf('%06d', $subfix + 1);
        }
        return "{$prefix}{$subfix}";
    }
}