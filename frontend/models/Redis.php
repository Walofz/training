<?php

namespace frontend\models;

use Yii;
use yii\helpers\Json;

class Redis
{
    private int $timeout = 60 * 60 * 24;
    public function setSession($username)
    {
        $hash = base64_encode($username);
        $role = $this->getRole(Session::getPreAccess($username));

        Yii::$app->session->set('username', $hash);

        if (!$keys = $this->command('hget', ["training:{$hash}", 'user'])) {
            $this->command('hset', ["training:{$hash}", 'user', $username, 'role', Json::encode($role)]);
            return Yii::$app->redis->executeCommand("expire training:{$hash} {$this->timeout}");
        }
    }

    public function getInfo($hash, $path)
    {
        return $this->command('hget', ["training:{$hash}", $path]);
    }

    public function checkSession($username)
    {
        if ($this->getInfo($username, 'user') == "")
            return Yii::$app->response->redirect(['site/login']);
    }

    public function logoutSession($hash): bool
    {
        $this->command('hdel', ["training:{$hash}", 'user', 'role']);
        Yii::$app->session->destroy();
        return Yii::$app->user->logout();
    }

    function command($cmd, $details)
    {
        return Yii::$app->redis->executeCommand($cmd, $details);
    }

    function getRole($obj): array
    {
        $tmp = [];
        $ex = explode('#', $obj);
        foreach ($ex as $item) {
            $tmp[] = $item;
        }
        return $tmp;
    }
}