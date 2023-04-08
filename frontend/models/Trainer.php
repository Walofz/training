<?php

namespace frontend\models;

use common\models\TrainnerTb;

/**
 *
 * @property-read string $newID
 */
class Trainer extends TrainnerTb
{

    public static function getTrainer(): array
    {
        $model = TrainnerTb::find()->all();
        $tmp = [];
//        $tmp[] = ['id' => '-', 'txt' => '-'];
        foreach ($model as $item) {
            $tmp[] = ['id' => $item->Trainner_ID, 'txt' => $item->Trainner_Name];
        }
        return $tmp;
    }

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