<?php

use frontend\models\CourseSearch;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/**
 * @var $this View
 * @var $model CourseSearch
 * @var $form ActiveForm
 */

$opt = [
    'class' => 'btn btn-success btncreate',
    'data-var' => "",
    'data-url' => Url::toRoute(['course/create']),
    'onclick' => 'openModal($(this))'
];
?>
<div class="course-search">
    <?php $form = ActiveForm::begin(['action' => ['index'], 'method' => 'get']) ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4">
                    <?= $form->field($model, 'globalSearch')->textInput(['placeholder' => 'ค้นหา', 'class' => 'form-control', 'aria-describedby' => 'basic-addon1', 'style' => 'width: 100%'])->label(false) ?>
                </div>
                <div class="col-lg-4">
                    <?= Html::button('เพิ่มใหม่', $opt) ?>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end() ?>
</div>