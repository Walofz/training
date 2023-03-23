<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var frontend\models\Training $model */

$this->title = $model->Course_ID;
$this->params['breadcrumbs'][] = ['label' => 'Trainings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="training-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'Course_ID' => $model->Course_ID, 'Location_ID' => $model->Location_ID, 'Train_Detail_ID' => $model->Train_Detail_ID, 'Trainer_ID' => $model->Trainer_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'Course_ID' => $model->Course_ID, 'Location_ID' => $model->Location_ID, 'Train_Detail_ID' => $model->Train_Detail_ID, 'Trainer_ID' => $model->Trainer_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Train_Detail_ID',
            'Course_ID',
            'Trainer_ID',
            'Location_ID',
            'Course_Cost',
            'User_Total',
            'Start_Train_Date',
            'End_Train_Date',
            'User_Create',
            'Date_Create',
        ],
    ]) ?>

</div>
