<?php

namespace frontend\models;

use common\models\LocationTb;
use common\models\ProviceTb;

class Location extends LocationTb
{

    public static function getProviceAll(): array
    {
        $model = ProviceTb::find()->all();
        $tmp = [];
        foreach ($model as $item) {
            $tmp[] = ['id' => $item->Provice_ID, 'txt' => $item->Provice_Name_TH];
        }
        return $tmp;
    }

    /**
     * @return array
     */
    public static function getLocation(): array
    {
        $model = Location::find()->all();
        $tmp = [];
        foreach ($model as $item) {
            $tmp[] = ['id' => $item->Location_ID, 'txt' => $item->Location_Name];
        }
        return $tmp;
    }

    public function getNewID(): string
    {
        $model = self::find()->max('Location_ID');
        $prefix = substr($model, 0, 2) ?? "LO";
        $subfix = (int)substr($model, 2, strlen($model)) ?? 1;
        if ($prefix != null && $subfix != null) {
            $subfix = sprintf('%06d', $subfix + 1);
        }
        return "{$prefix}{$subfix}";
    }
}