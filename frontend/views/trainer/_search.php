<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\TrainerSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="trainner-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Trainner_ID') ?>

    <?= $form->field($model, 'Trainner_Name') ?>

    <?= $form->field($model, 'Trainner_Descrition') ?>

    <?= $form->field($model, 'Trainner_From') ?>

    <?= $form->field($model, 'User_Create') ?>

    <?php // echo $form->field($model, 'Date_Create') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
