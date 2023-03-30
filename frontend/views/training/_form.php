<?php

use frontend\models\Course;
use frontend\models\Location;
use frontend\models\Trainer;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\JqueryAsset;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\Training $model */
/** @var yii\widgets\ActiveForm $form */

$uri = Url::base();
$this->registerJsFile("{$uri}/js/training/form.js", ['depends' => JqueryAsset::class]);
?>
<div class="training-form">
    <?php $form = ActiveForm::begin(); ?>
    <input type="hidden" name="" class="recid" value="<?= $model->Train_Detail_ID ?>">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <?= $form->field($model, 'Course_ID')->widget(Select2::class, [
                        'data' => ArrayHelper::map(Course::getCourse(), 'id', 'txt'),
                        'pluginOptions' => ['dropdownParent' => '#tempModal'],
                        'options' => ['onchange' => 'addedData()', 'class' => 'cos_select']
                    ])->label('หลักสูตรการอบรม') ?>
                </div>
                <div class="col-lg-12">
                    <?= $form->field($model, 'Location_ID')->widget(Select2::class, [
                        'data' => ArrayHelper::map(Location::getLocation(), 'id', 'txt'),
                        'pluginOptions' => ['dropdownParent' => '#tempModal']
                    ])->label('สถานที่อบรม') ?>
                </div>
                <div class="col-lg-12">
                    <?= $form->field($model, 'Trainer_ID')->widget(Select2::class, [
                        'data' => ArrayHelper::map(Trainer::getTrainer(), 'id', 'txt'),
                        'pluginOptions' => ['dropdownParent' => '#tempModal']
                    ])->label('วิทยากร') ?>
                </div>
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <?php $model->Start_Train_Date = ($model->isNewRecord ? date('d/m/Y') : date('d/m/Y', strtotime($model->Start_Train_Date))) ?>
                            <?= $form->field($model, 'Start_Train_Date')->widget(DatePicker::class, [
                                'name' => 'startdt',
                                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'format' => 'dd/mm/yyyy'
                                ]
                            ])->label('วันที่เริ่ม') ?>
                        </div>
                        <div class="col-lg-6">
                            <?php $model->End_Train_Date = ($model->isNewRecord ? date('d/m/Y') : date('d/m/Y', strtotime($model->End_Train_Date))) ?>
                            <?= $form->field($model, 'End_Train_Date')->widget(DatePicker::class, [
                                'name' => 'enddt',
                                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'format' => 'dd/mm/yyyy'
                                ]
                            ])->label('วันที่สิ้นสุด') ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-3">
                            <?= Html::label('ค่าใช้จ่ายยอดรวม (บาท)', 'txtcourse') ?>
                            <?= Html::textInput('', number_format($model->Course_Cost ?? 0, 2, '.', ','), ['class' => 'form-control txtcourse', 'readonly' => true, 'style' => 'text-align: right']) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= Html::label('เอกสารอ้างอิง', 'txtdoc') ?>
                            <?= Html::textInput('', '', ['class' => 'form-control txtdoc', 'readonly' => true, 'style' => 'text-align: right']) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= Html::label('จำนวนผู้อบรม', 'txttotal') ?>
                            <?= Html::textInput('', $model->User_Total ?? 0, ['class' => 'form-control txttotal', 'readonly' => true, 'style' => 'text-align: right']) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= Html::label('ค่าใช้จ่ายต่อคน (บาท)', 'txtpercost') ?>
                            <?php $calc = $model->isNewRecord ? 0 : $model->Course_Cost / $model->User_Total ?>
                            <?= Html::textInput('', number_format($calc, 2, '.', ','), ['class' => 'form-control txtpercost', 'readonly' => true, 'style' => 'text-align: right']) ?>
                        </div>
                    </div>
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
        <button type="submit" class="btn btn-success" style="visibility: <?= (!in_array('W4', $tmp)) ? 'hidden' : '' ?>">บันทึก</button>
        <button type="button" class="btn btn-warning" data-dismiss="modal" onclick="$('#tempModal').modal('hide')">ปิด</button>
    </div>
    <?php ActiveForm::end(); ?>
</div>
