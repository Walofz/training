<?php

use frontend\models\Course;
use frontend\models\Location;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\Training $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="training-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <?= $form->field($model, 'Course_ID')->widget(Select2::class, [
                        'data' => ArrayHelper::map(Course::getCourse(), 'id', 'txt'),
                        'pluginOptions' => ['dropdownParent' => '#tempModal']
                    ])->label('หลักสูตรการอบรม') ?>
                </div>
                <div class="col-lg-12">
                    <?= $form->field($model, 'Location_ID')->widget(Select2::class, [
                        'data' => ArrayHelper::map(Location::getLocation(), 'id', 'txt'),
                        'pluginOptions' => ['dropdownParent' => '#tempModal']
                    ])->label('สถานที่อบรม') ?>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
