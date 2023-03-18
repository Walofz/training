<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JqueryAsset;

/** @var yii\web\View $this */
/** @var frontend\models\TrainerSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
$path = Yii::$app->viewPath;
$uri = Url::base();

$this->title = "";
$this->registerJsFile("{$uri}/js/trainer/index.js", ['depends' => JqueryAsset::class]);

require_once "{$path}/course/modal/_template.php";
?>
<div class="trainner-index" style="font-family: Kanit-Light, serif">
    <?php try {
        print GridView::widget(config: [
            'dataProvider' => $dataProvider,
            'pjax' => true,
            'bordered' => true,
            'condensed' => false,
            'hover' => true,
            'responsive' => true,
            'panel' => [
                'heading' => '<i class="fas fa-users"></i>  วิทยากร',
                'type' => 'primary',
                'after' => false,
                'before' => $this->render('_search', ['model' => $searchModel])
            ],
            'toolbar' => [],
            'export' => [
                'fontAwesome' => true
            ],
            'columns' => [
                'Trainner_ID:raw:รหัส',
                'Trainner_Name:raw:ชื่อ',
                'Trainner_Descrition:raw:รายละเอียด',
                'Trainner_From:raw:มาจาก',
                [
                    'header' => 'จัดการ',
                    'class' => 'yii\grid\ActionColumn',
                    'headerOptions' => ['style' => 'text-align: center'],
                    'contentOptions' => ['style' => 'text-align: center'],
                    'template' => '{update}',
                    'buttons' => [
                        'update' => function ($url, $model) {
                            $opt = [
                                'class' => 'btnedit',
                                'data-var' => "{$model->Trainner_ID}",
                                'data-url' => Url::toRoute(['trainer/update', 'id' => $model->Trainner_ID]),
                                'onclick' => 'openModal($(this))'
                            ];
                            $ico = "<span class='fas fa-file-alt btn btn-warning btn-sm'></span>";
                            return Html::a($ico, 'javascript:void(0)', $opt);
                        }
                    ]
                ]
            ]
        ]);
    } catch (Throwable $exception) {
        print $exception->getMessage();
    } ?>
</div>
