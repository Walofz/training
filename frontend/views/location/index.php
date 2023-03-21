<?php

use common\models\ProviceTb;
use frontend\models\LocationSearch;
use kartik\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JqueryAsset;
use yii\web\View;

/**
 * @var $this View
 * @var $searchModel LocationSearch
 * @var $dataProvider ActiveDataProvider;
 */

$path = Yii::$app->viewPath;
$uri = Url::base();

$this->title = "";
$this->registerJsFile("{$uri}/js/location/index.js", ['depends' => JqueryAsset::class]);
require_once "{$path}/course/modal/_template.php";
?>
<div class="location-tb" style="font-family: Kanit-Light, serif;">
    <?php try {
        print GridView::widget(config: [
            'dataProvider' => $dataProvider,
            'pjax' => true,
            'bordered' => true,
            'condensed' => false,
            'hover' => true,
            'responsive' => true,
            'panel' => [
                'heading' => '<i class="fas fa-map-signs"></i>  สถานที่อบรม',
                'type' => 'primary',
                'after' => false,
                'before' => $this->render('_search', ['model' => $searchModel])
            ],
            'toolbar' => [],
            'export' => [
                'fontAwesome' => true
            ],
            'columns' => [
                'Location_ID:raw:รหัส',
                'Location_Name:raw:ชื่อ',
                'Location_Description:raw:รายละเอียด',
                [
                    'attribute' => 'Location_Provice',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return ProviceTb::findOne($model)->Provice_Name_TH ?? "";
                    },
                    'label' => 'จังหวัด'
                ],
                'Location_Tel:raw:เบอร์โทรฯ',
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
                                'data-var' => "{$model->Location_Name}",
                                'data-url' => Url::toRoute(['location/update', 'id' => $model->Location_ID]),
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
