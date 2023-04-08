<?php

namespace frontend\models;

use common\models\QryEmpInfoEmpAll;
use common\models\TrainingDetailTb;

class Training extends TrainingDetailTb
{

    /**
     * @return array
     */
    public static function getEmplist(): array
    {
        $model = QryEmpInfoEmpAll::find()->all();
        $tmp = [];
        $tmp[] = ['empicard' => '', 'txt' => '-'];
        foreach ($model as $item) {
            /* @var $item QryEmpInfoEmpAll */
            $tmp[] = ['empicard' => $item->PRS_NO, 'txt' => "{$item->PRS_NO} | {$item->EMP_NAME} {$item->EMP_SURNME}"];
        }
        return $tmp;
    }

    public function getNewRecord()
    {
        $model = Training::find()->max('Train_Detail_ID');
        return $model + 1;
    }
}