<?php

use kartik\grid\GridView;
use yii\web\View;

/**
 * @var $this View
 */

$this->title = "";
?>
<div class="" style="font-family: Kanit-Light, serif">
    <div class="card card-gray">
        <div class="card-header">
            <h5>หลักสูตรการอบรม</h5>
        </div>
        <div class="card-body">
            <div class="card card-default">
                <div class="card-header">
                    <?= $this->render('_search', ['model' => $searchModel]) ?>
                </div>
            </div>
        </div>
    </div>
</div>