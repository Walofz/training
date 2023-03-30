<?php

use yii\helpers\Json;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\Trainer $model */
/** @var yii\widgets\ActiveForm $form */
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
                    <?= $form->field($model, 'Trainner_Descrition')->textarea(['class' => 'trainner_name form-control', 'style' => 'resize:none', 'rows' => 5])->label('รายละเอียด') ?>
                </div>
                <div class="col-lg-12">
                    <?= $form->field($model, 'Trainner_From')->textInput(['class' => 'form-control'])->label('มาจาก') ?>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="modal-footer">
        <?php
        $userRole = (new \frontend\models\Redis())->getInfo(Yii::$app->session->get('username'), 'role');
        $tmp = Json::decode($userRole);
        ?>
        <button type="submit" class="btn btn-success" style="visibility: <?= (!in_array('W2', $tmp)) ? 'hidden' : '' ?>">บันทึก</button>
        <button type="button" class="btn btn-warning" data-dismiss="modal" onclick="$('#tempModal').modal('hide')">ปิด</button>
    </div>
    <?php ActiveForm::end(); ?>
</div>
