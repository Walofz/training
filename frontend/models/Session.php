<?php

namespace frontend\models;

use common\models\PRODSPECACCESS;
use Yii;

class Session
{
    private string $subtext = "@cicnetgrp.net";

    function getSubtext(): string
    {
        return $this->subtext;
    }
    public static function checkLogin()
    {
        if ($user = Yii::$app->session->get('username')) {
            if ($user != "") (new Redis())->checkSession($user);
            else return Yii::$app->response->redirect(['site/logout-session']);
            $usr = (new Redis())->getInfo($user, 'user');
        }

        return $usr ?? "";
    }

    public static function getPreAccess($username): string
    {
        $sx = (new Session())->getSubtext();
        $model = PRODSPECACCESS::findOne(['USER_ID' => "{$username}{$sx}"]);
        return $model->USER_PERMISSION_CODE ?? "";
    }

    public static function getFullname($username): string
    {
        $sx = (new Session())->getSubtext();
        $model = PRODSPECACCESS::findOne(['USER_ID' => "{$username}{$sx}"]);
        return $model->USER_NAME ?? "";
    }

    public static function getUserID($username): string
    {
        $sx = (new Session())->getSubtext();
        $model = PRODSPECACCESS::findOne(['USER_ID' => "{$username}{$sx}"]);
        return $model->USER_ID ?? "";
    }
}