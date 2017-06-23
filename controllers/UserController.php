<?php
/**
 * Created by PhpStorm.
 * User: M
 * Date: 17/6/20
 * Time: 下午5:02
 */

namespace app\controllers;

use Yii;
use app\models\System;
use yii\web\NotFoundHttpException;

class UserController extends Controller
{
    public function actionHome()
    {
        $model = new System();
        return $this->render('home',[
            'model' => $model
        ]);
    }

    public function actionList()
    {
        return $this->render('list');
    }
}