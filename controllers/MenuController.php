<?php

namespace app\controllers;

use Yii;
use app\models\Menu;
use app\models\search\MenuSearch;

/**
 * 菜单管理
 * Class MenuController
 * @package app\controllers
 */
class MenuController extends Controller
{
    /**
     * 列表
     * @return string
     */
    public function actionList()
    {
        $searchModel = new MenuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('list',[
            'searchModel'=>$searchModel,
            'dataProvider'=>$dataProvider
        ]);
    }

    /**
     * 创建
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        return $this->save();
    }

    /**
     * 更新
     * @return string|\yii\web\Response
     */
    public function actionUpdate()
    {
        return $this->save(false);
    }

    /**
     * 详情
     * @return string
     */
    public function actionDetail()
    {
        return $this->render('detail',[
            'model' => $this->findModel()
        ]);
    }

    /**
     * 删除
     * @return \yii\web\Response
     * @throws \Exception
     * @throws \Throwable
     */
    public function actionDelete()
    {
        if($this->findModel()->delete()){
            $this->alert(Yii::t('common','Delete Successfully'), self::ALERT_SUCCESS);
        }else{
            $this->alert(Yii::t('common','Delete Failure'));
        }
        return $this->redirect('list');
    }

    public function actionSort()
    {
        $menus = Menu::getMenus();
        $this->varDumpPre($menus);die;
    }

    /**
     * 保存
     * @param bool $isCreate
     * @return string|\yii\web\Response
     * @throws \yii\web\NotFoundHttpException
     */
    private function save($isNewRecord = true)
    {
        $model = $isNewRecord ? new Menu() : $this->findModel();

        $request = Yii::$app->request;
        if($request->isPost){
            if($model->load($request->post()) && $model->validate()){
                if($model->save(false)){
                    $this->alert(Yii::t('common', $isNewRecord ? 'Create Successfully' : 'Update Successfully'), self::ALERT_SUCCESS);
                    if($isNewRecord){
                        return $this->redirect('create');
                    }
                }else{
                    $this->alert(Yii::t('common', $isNewRecord ? 'Create Failure' : 'Update Failure'));
                }
            }else{
                $this->exception(Yii::t('common', 'Illegal Operation'));
            }
        }
        return $this->render('form',[
            'model' => $model
        ]);
    }

    /**
     * 查询
     * @return  Menu the loaded model
     * @throws \yii\web\NotFoundHttpException
     */
    public function findModel()
    {
        $id = (int) Yii::$app->request->get('id', 0);
        if($id){
            if(($model = Menu::findOne($id)) !== null){
                return $model;
            }
        }
        $this->exception(Yii::t('common', 'Illegal Request'));
    }
}