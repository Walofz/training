<?php

use frontend\models\CourseSearch;
use yii\bootstrap5\ActiveForm;
use yii\web\View;

/**
 * @var $this View
 * @var $model CourseSearch
 * @var $form ActiveForm
 */
?>
<div class="course-search">
    <?php $form = ActiveForm::begin(['action' => ['index'], 'method' => 'get']) ?>
    <div class="input-group" style="text-align: right;width: 100%;">
        <?= $form->field($model, 'globalSearch')->textInput(['placeholder' => 'ค้นหา', 'class' => 'form-control', 'aria-describedby' => 'basic-addon1', 'style' => 'width: 100%'])->label(false) ?>
    </div>
    <?php ActiveForm::end() ?>
</div>