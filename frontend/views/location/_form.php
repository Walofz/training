<?php

use frontend\models\Location;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var $model Location
 * @var $this View
 */

$uri = Url::base();
?>
<div class="form-data">
    <?php $form = ActiveForm::begin() ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4">
                    <?php $model->Location_ID = ($model->isNewRecord) ? "LOXXXXXX" : $model->Location_ID ?>
                    <?= $form->field($model, 'Location_ID')->textInput(['readonly' => true])->label('รหัสสถานที่อบรม') ?>
                </div>
                <div class="col-lg-8">
                    <?= $form->field($model, 'Location_Name')->textInput(['class' => 'form-control'])->label('สถานที่') ?>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <?= $form->field($model, 'Location_Description')->textarea(['class' => 'form-control', 'style' => 'resize:none', 'rows' => 5])->label('รายละเอียด') ?>
                </div>
                <div class="col-lg-6">
                    <?= $form->field($model, 'Location_Provice')->widget(Select2::class, config: [
                        'data' => ArrayHelper::map(Location::getProviceAll(), 'id', 'txt')
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end() ?>
</div>