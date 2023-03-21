<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Location $model */

$this->title = 'Update Location: ' . $model->Location_ID;
$this->params['breadcrumbs'][] = ['label' => 'Locations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Location_ID, 'url' => ['view', 'Location_ID' => $model->Location_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="location-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
