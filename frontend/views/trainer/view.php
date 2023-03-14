<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var frontend\models\Trainer $model */

$this->title = $model->Trainner_ID;
$this->params['breadcrumbs'][] = ['label' => 'Trainners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="trainner-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'Trainner_ID' => $model->Trainner_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'Trainner_ID' => $model->Trainner_ID], [
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
            'Trainner_ID',
            'Trainner_Name',
            'Trainner_Descrition',
            'Trainner_From',
            'User_Create',
            'Date_Create',
        ],
    ]) ?>

</div>
