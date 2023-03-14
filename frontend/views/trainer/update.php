<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Trainer $model */

$this->title = 'Update Trainner: ' . $model->Trainner_ID;
$this->params['breadcrumbs'][] = ['label' => 'Trainners', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Trainner_ID, 'url' => ['view', 'Trainner_ID' => $model->Trainner_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trainner-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
