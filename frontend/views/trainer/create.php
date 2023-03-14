<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Trainer $model */

$this->title = 'Create Trainner';
$this->params['breadcrumbs'][] = ['label' => 'Trainners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trainner-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
