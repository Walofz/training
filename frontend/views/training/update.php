<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Training $model */

$this->title = 'Update Training: ' . $model->Course_ID;
$this->params['breadcrumbs'][] = ['label' => 'Trainings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Course_ID, 'url' => ['view', 'Course_ID' => $model->Course_ID, 'Location_ID' => $model->Location_ID, 'Train_Detail_ID' => $model->Train_Detail_ID, 'Trainer_ID' => $model->Trainer_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="training-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
