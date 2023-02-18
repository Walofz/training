<?php

use common\models\LoginForm;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JqueryAsset;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var $this View
 * @var $form ActiveForm
 * @var $model LoginForm
 */

$uri = Url::base();
$base = Yii::$app->request->baseUrl;

try {
    $this->registerCssFile("{$uri}/css/login/main.css", ['depends' => JqueryAsset::class]);
    $this->registerCssFile("{$uri}/css/login/util.css", ['depends' => JqueryAsset::class]);
} catch (InvalidConfigException $e) {
}
?>
<div class="site-login">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt">
                <img src="<?= "{$base}/pics/camel.png" ?>" alt="IMG">
            </div>
            <div class="login100-form validate-form">
                <span class="login100-form-title">
                    <label for="">โปรแกรม <b>C</b>amel <b>T</b>raining</label>
                </span>

                <?php $form =ActiveForm::begin(['id' => 'login-form']) ?>
                <div class="wrap-input100 validate-input" data-validate="Required : ชื่อผู้ใช้งาน">
                    <?= $form->field($model,'username')->textInput(['class' => 'input100', 'placeholder' => 'ชื่อผู้ใช้งาน'])->label('') ?>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Required : รหัสผ่าน">
                    <?= $form->field($model, 'password')->passwordInput(['class' => 'input100', 'placeholder' => 'รหัสผ่าน'])->label('') ?>
                </div>

                <div class="container-login100-form-btn">
                    <?= Html::submitButton('Login', ['class' => 'login100-form-btn', 'name' => 'login-button']) ?>
                </div>
                <div class="container-login100-form-btn">
                    <b>Version</b> &ensp; <?= Yii::getAlias('@version') ?>
                </div>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>