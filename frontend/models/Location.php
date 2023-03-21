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
}