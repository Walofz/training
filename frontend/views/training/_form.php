<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\Training $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="training-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Train_Detail_ID')->textInput() ?>

    <?= $form->field($model, 'Course_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Trainer_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Location_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Course_Cost')->textInput() ?>

    <?= $form->field($model, 'User_Total')->textInput() ?>

    <?= $form->field($model, 'Start_Train_Date')->textInput() ?>

    <?= $form->field($model, 'End_Train_Date')->textInput() ?>

    <?= $form->field($model, 'User_Create')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Date_Create')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
