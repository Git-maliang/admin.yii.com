<?php
/**
 * Created by PhpStorm.
 * User: M
 * Date: 17/6/23
 * Time: 上午10:36
 */

namespace app\controllers;

use Yii;
use app\models\search\MenuSearch;

class MenuController extends Controller
{
    public function actionList()
    {
        $searchModel = new MenuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('list',[
            'searchModel'=>$searchModel,
            'dataProvider'=>$dataProvider
        ]);
    }
}