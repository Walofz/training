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

    <?php ActiveForm::end() ?>
</div>