<?php

use frontend\models\CourseSearch;
use kartik\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\web\View;

/**
 * @var $this View
 * @var $searchModel CourseSearch
 * @var $dataProvider ActiveDataProvider
 */

$this->title = "";
?>
<div class="" style="font-family: Kanit-Light, serif">
    <div class="card card-gray">
        <div class="card-header">
            <h5>หลักสูตรการอบรม</h5>
        </div>
        <div class="card-body">
            <div class="">
                <?= $this->render('_search', ['model' => $searchModel]) ?>
            </div>
            <div class="">
                <?php try {
                    print GridView::widget([
                        'dataProvider' => $dataProvider,
                        'panel' => [
                            'type' => 'info'
                        ],
                        'pjax' => true,
                        'toolbar' => [],
                        'showFooter' => false,
                        'options' => [
                            'resizableColumns' => true,
                            'resizableColumnsOptions' => ['resizeFromBody' => true],
                            'persistResize' => true,
                        ],
                        'columns' => [
                            'Course_ID:raw:รหัส',
                            'Course_Name:raw:ชื่อ',
                            'Document_ID:raw:อ้างอิง',
                        ]
                    ]);
                } catch (Throwable $e) {
                    print $e->getMessage();
                } ?>
            </div>
        </div>
    </div>
</div>