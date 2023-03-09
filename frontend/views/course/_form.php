<?php

use frontend\models\Course;
use frontend\models\Redis;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\JqueryAsset;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var $model Course
 * @var $this View
 */

$uri = Url::base();
$this->registerJsFile("{$uri}/js/course/form.js", ['depends' => JqueryAsset::class]);
?>
<div class="form-data">
    <?php $form = ActiveForm::begin() ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4">
                    <?php $model->Course_ID = ($model->isNewRecord ? "COXXXXXX" : $model->Course_ID) ?>
                    <?= $form->field($model, 'Course_ID')->textInput(['readonly' => true])->label('รหัสหลักสูตรการอบรม') ?>
                </div>
                <div class="col-lg-8">
                    <?= $form->field($model, 'Document_ID')->widget(Select2::class, [
                        'data' => ArrayHelper::map(Course::getDocument(), 'id', 'txt'),
                        'pluginOptions' => ['dropdownParent' => '#tempModal'],
                        'options' => ['onchange' => 'addedData()', 'class' => 'doc_select']
                    ])->label('เอกสาร ISO ( ถ้าเกี่ยวข้อง )') ?>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <?= $form->field($model, 'Course_Name')->textarea(['class' => 'course_name form-control', 'style' => 'resize:none', 'rows' => 5])->label('ชื่อหลักสูตรการอบรม') ?>
                </div>
                <div class="col-lg-12">
                    <?= $form->field($model, 'Course_Description')->textarea(['class' => 'course_desc form-control', 'style' => 'resize:none', 'rows' => 5])->label('รายละเอียดหลักสูตรการอบรม') ?>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-6">
                    <?= $form->field($model, 'Course_Type')->widget(Select2::class, [
                        'data' => ArrayHelper::map(Course::getType(), 'id', 'txt'),
                        'pluginOptions' => ['dropdownParent' => '#tempModal']
                    ])->label('ประเภทสูตรการอบรม') ?>
                </div>
                <div class="col-lg-6">
                    <?= $form->field($model, 'Course_Cost')->textInput(['type' => 'number'])->label('ค่าใช้จ่ายในหลักสูตรการอบรม') ?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <?php
        $userRole = (new Redis())->getInfo(Yii::$app->session->get('username'), 'role');
        $tmp = Json::decode($userRole);
        ?>
        <button type="submit" class="btn btn-success" style="visibility: <?= (!in_array('W1', $tmp)) ? 'hidden' : '' ?>">บันทึก</button>
        <button type="button" data-dismiss="modal" class="btn btn-warning" onclick="$('#tempModal').modal('hide')">ปิด</button>
    </div>
    <?php ActiveForm::end() ?>
</div>