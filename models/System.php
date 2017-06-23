<?php
/**
 * Created by PhpStorm.
 * User: M
 * Date: 17/4/6
 * Time: 上午9:45
 */

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "{{%area}}".
 *
 * @property string $username
 * @property string $role
 * @property string $lastTime
 * @property string $lastIp
 * @property string $system
 * @property string $server
 * @property string $mysql
 * @property string $php
 * @property string $yii
 * @property string $upload
 */
class System extends Model
{
    public $username;
    public $role;
    public $lastTime;
    public $lastIp;
    public $system;
    public $server;
    public $mysql;
    public $php;
    public $yii;
    public $upload;

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => '账号',
            'role' => '角色',
            'lastTime' => '上次登录时间',
            'lastIp' => '上次登录IP ',
            'system' => '操作系统 ',
            'server' => '服务器软件 ',
            'mysql' => 'MySQL版本 ',
            'php' => 'PHP版本 ',
            'yii' => 'Yii版本 ',
            'upload' => '上传文件',
        ];
    }

    /**
     * 获取登录信息
     * @return System
     */
    public function init()
    {
        $admin = Yii::$app->user->identity;
        //$this->username = $admin->username;
        $this->username = 'Admin';
        //$this->role = AuthAssignment::getUserRole();
        $this->role = '超级管理员';
        //$this->lastTime = $admin->last_time ? date('Y-m-d H:i:s', $admin->last_time) : '';
        $this->lastTime = date('Y-m-d H:i:s');
        //$this->lastIp = $admin->last_ip ? long2ip($admin->last_ip): '';
        $this->lastIp = Yii::$app->request->userIP;
        $system = explode(' ', php_uname());
        $this->system = $system[0] .'&nbsp;' . ('/' == DIRECTORY_SEPARATOR ? $system[2] : $system[1]);
        $this->server = $_SERVER['SERVER_SOFTWARE'];
        $this->mysql = Yii::$app->db->createCommand('SELECT VERSION() AS `version`')->queryScalar();
        $this->php = 'PHP '. PHP_VERSION;
        $this->yii =  'Yii '. Yii::getVersion();
        $this->upload =  ini_get('upload_max_filesize');

        parent::init();
    }
}