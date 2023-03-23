<?php

use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\TrainingSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="training-search">
    <?php $form = ActiveForm::begin(['action' => ['index'], 'method' => 'get']) ?>
    
    <?php ActiveForm::end() ?>
</div>
