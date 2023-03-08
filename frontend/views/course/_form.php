<?php

use frontend\models\Course;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/**
 * @var $model Course
 */

//print $model->Course_ID;
?>
<div class="form-data">
    <?php $form = ActiveForm::begin() ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4">
                    <?= $form->field($model, 'Course_ID')->textInput(['readonly' => true])->label('รหัสหลักสูตรการอบรม') ?>
                </div>
                <div class="col-lg-8">
                    <?= $form->field($model, 'Document_ID')->widget(Select2::class, [
                        'data' => ArrayHelper::map(Course::getDocument(), 'id', 'txt')
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
    </div>
    <?php ActiveForm::end() ?>
</div>