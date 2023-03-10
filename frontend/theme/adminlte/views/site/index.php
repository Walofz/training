<?php

use frontend\models\Session;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\JqueryAsset;
use yii\web\View;

/**
 * @var $this View
 */
Session::checkLogin();

$uri = Url::base();
$path = Yii::$app->viewPath;
$usr = Yii::$app->session->get('username');
$usrc = Session::checkLogin();
if ($usrc == "") return Yii::$app->response->redirect(['site/logout-session']);

$tmp_role = (new \frontend\models\Redis())->getInfo($usr, 'role');

$this->title = "";
$this->registerJsFile("{$uri}/js/index.js", ['depends' => JqueryAsset::class]);
?>
<div class="" style="font-family: Kanit-Light, serif">
    <?php if (count(Json::decode($tmp_role)) == 0): ?>
        <div class="card card-primary">
            <div class="card-body">
                <h5>กรุณาติดต่อ ฝ่ายสารสนเทศ เพื่อขอสิทธิ์การเข้าถึงข้อมูล</h5>
            </div>
        </div>
    <?php else: ?>
        <div class="container-fluid">

        </div>
    <?php endif; ?>
</div>