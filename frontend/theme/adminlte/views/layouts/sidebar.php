<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <?php

    use frontend\models\Redis;
    use frontend\models\Session;
    use hail812\adminlte\widgets\Menu;
    use yii\helpers\Json;
    use yii\helpers\Url;

    $hash = Yii::$app->session->get('username');
    $usr = Session::checkLogin();
    if ($usr == "") return Yii::$app->response->redirect(['site/logout-session']);

    $userRole = (new Redis())->getInfo($hash, 'role');
    $userFname = Session::getFullname((new Redis())->getInfo($hash, 'user'));

    $tmp = Json::decode($userRole);
    ?>
    <a href="<?= Url::home() ?>" class="brand-link">
        <span class="brand-text font-weight-light">&ensp;TRAINING ONLINE</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= Url::base() . '/pics/camel.png' ?>" alt="logo" class="img-circle elevation-2">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= $userFname ?></a>
            </div>
        </div>

        <nav class="mt-2">
            <?= Menu::widget([
                'items' => [
                    ['label' => 'หน้าแรก', 'icon' => 'home', 'url' => ['/site/index']]
                ]
            ]) ?>

            <?php if (in_array('R1', $tmp) || in_array('W1', $tmp)) : ?>
                <?= Menu::widget([
                    'items' => [
                        ['label' => 'หลักสูตรการอบรม', 'icon' => 'archive', 'url' => ['/course/index']]
                    ]
                ]) ?>
            <?php endif; ?>

            <?php if (in_array('R2', $tmp) || in_array('W2', $tmp)) : ?>
                <?= Menu::widget([
                    'items' => [
                        ['label' => 'วิทยากร', 'icon' => 'users', 'url' => ['/trainer/index']]
                    ]
                ]) ?>
            <?php endif; ?>

            <?php if (in_array('R3', $tmp) || in_array('W3', $tmp)) : ?>
                <?= Menu::widget([
                    'items' => [
                        ['label' => 'สถานที่อบรม', 'icon' => 'map-signs', 'url' => ['/training_facility/index']]
                    ]
                ]) ?>
            <?php endif; ?>

            <?php if (in_array('R4', $tmp) || in_array('W4', $tmp)) : ?>
                <?= Menu::widget([
                    'items' => [
                        ['label' => 'การอบรม', 'icon' => 'signature', 'url' => ['/training/index']]
                    ]
                ]) ?>
            <?php endif; ?>

            <?php if (in_array('R5', $tmp) || in_array('W5', $tmp)) : ?>
                <?= Menu::widget([
                    'items' => [
                        ['label' => 'รายงาน', 'icon' => 'file', 'url' => ['/reports/index']]
                    ]
                ]) ?>
            <?php endif; ?>

            <?php if (in_array('R18', $tmp) || in_array('W18', $tmp)) : ?>
                <?= Menu::widget([
                    'items' => [
                        ['label' => 'ฝ่ายไอที', 'header' => true],
                        ['label' => 'จัดการผู้ใช้', 'icon' => 'cogs', 'url' => ['/setting/index']]
                    ]
                ]) ?>
            <?php endif; ?>
        </nav>
    </div>
</aside>