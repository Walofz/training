<?php

use frontend\models\Trainer;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var frontend\models\TrainerSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Trainners';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trainner-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Trainner', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Trainner_ID',
            'Trainner_Name',
            'Trainner_Descrition',
            'Trainner_From',
            'User_Create',
            //'Date_Create',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Trainer $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'Trainner_ID' => $model->Trainner_ID]);
                }
            ],
        ],
    ]); ?>


</div>
