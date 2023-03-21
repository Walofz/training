<?php

namespace frontend\models;

use common\models\TrainnerTb;

class Trainer extends TrainnerTb
{

    public function getNewID(): string
    {
        $model = self::find()->max('Trainner_ID');
        $prefix = substr($model, 0, 3) ?? "TRN";
        $subfix = (int)substr($model, 3, strlen($model)) ?? 1;
        if ($prefix != null && $subfix != null)
            $subfix = sprintf('%05d', $subfix + 1);
        return "{$prefix}{$subfix}";
    }
}