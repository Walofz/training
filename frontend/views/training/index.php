<?php

use frontend\models\TrainingSearch;
use kartik\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\JqueryAsset;
use yii\web\View;

/**
 * @var $this View
 * @var $searchModel TrainingSearch
 * @var $dataProvider ActiveDataProvider
 */
$path = Yii::$app->viewPath;
$uri = Url::base();

$this->title = "";
$this->registerJsFile("{$uri}/js/taining/index.js", ['depends' => JqueryAsset::class]);

require_once "{$path}/course/modal/_template.php";
?>
<div class="training">
    <?php try {
        print GridView::widget(config: [
            'dataProvider' => $dataProvider,
            'pjax' => true,
            'bordered' => true,
            'condensed' => false,
            'hover' => true,
            'responsive' => true,
            'panel' => [
                'heading' => '<i class="fas fa-signature"></i>  การอบรม',
                'type' => 'primary',
                'after' => false,
                'before' => $this->render('_search', ['model' => $searchModel])
            ],
            'toolbar' => [],
            'export' => [
                'fontAwesome' => true
            ],
        ]);
    } catch (Throwable $exception) {
        print $exception->getMessage();
    } ?>
</div>