<?php

use common\models\TrainingTb;
use frontend\models\Training;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\JqueryAsset;
use yii\web\View;

/**
 * @var $model TrainingTb
 * @var $this View
 * @var $mainprod
 */

//var_export($model);
$uri = Url::base();
$this->registerJsFile("{$uri}/js/training/empform.js", ['depends' => JqueryAsset::class]);
$this->registerCssFile("{$uri}/css/rounds.css", ['depends' => JqueryAsset::class]);
?>
<input type="hidden" name="" id="" class="form-control mainprod" value="<?= $mainprod ?>">
<div class="form-emp">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-8">
                    <?= Select2::widget(config: [
                        'name' => 'empselected',
                        'data' => ArrayHelper::map(Training::getEmplist(), 'empicard', 'txt'),
                        'pluginOptions' => ['dropdownParent' => '#tempModal'],
                        'options' => ['class' => 'empselect']
                    ]) ?>
                </div>
                <div class="col-lg-4">
                    <button type="button" class="btn btn-success" onclick="addedData()">เพิ่มพนักงาน</button>
                </div>
            </div>
        </div>
        <div class="col-lg-12" style="padding-top: 1.25em">
            <div class="row">
                <table class="table table-emp">
                    <thead>
                    <tr>
                        <th>ชื่อ - นามสกุล ผู้เข้าอบรม</th>
                        <th style="text-align: center;">สถานะ</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>