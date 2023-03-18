<?php

use yii\helpers\Url;
use yii\web\JqueryAsset;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\Trainer $model */
/** @var yii\widgets\ActiveForm $form */
$uri = Url::base();
$this->registerJsFile("{$uri}/js/trainer/form.js", ['depends' => JqueryAsset::class]);
?>
<div class="trainner-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4">
                    <?php $model->Trainner_ID = ($model->isNewRecord ? "TRNXXXXX" : $model->Trainner_ID) ?>
                    <?= $form->field($model, 'Trainner_ID')->textInput(['readonly' => true])->label('รหัสวิทยากร') ?>
                </div>
                <div class="col-lg-8">
                    <?= $form->field($model, 'Trainner_Name')->textInput()->label('ชื่อ') ?>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">

                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
