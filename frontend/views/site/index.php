<?php
$usr = Session::checkLogin();
if ($usr == "") return Yii::$app->response->redirect(['site/logout-session']);