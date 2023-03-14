<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\Trainer $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="trainner-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Trainner_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Trainner_Name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Trainner_Descrition')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Trainner_From')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'User_Create')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Date_Create')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
