<?php

namespace app\controllers;

use Yii;
use app\models\Admin;
use app\models\search\AdminSearch;

/**
 * 管理员
 * Class AdminController
 * @package app\controllers
 */
class AdminController extends Controller
{
    /**
     * 列表
     * @return string
     */
    public function actionList()
    {
        $searchModel = new AdminSearch();
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
    public function actionView()
    {
        return $this->render('view',[
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
        $model = $this->findModel();
        if($model->delete()){
            $this->operateId = $model->id;
            $this->alert(Yii::t('common','Delete Successfully'), self::ALERT_SUCCESS);
        }else{
            $this->alert(Yii::t('common','Delete Failure'));
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * 保存
     * @param bool $isCreate
     * @return string|\yii\web\Response
     * @throws \yii\web\NotFoundHttpException
     */
    private function save($isNewRecord = true)
    {
        $model = $isNewRecord ? new Admin() : $this->findModel();

        $request = Yii::$app->request;
        if($request->isPost){
            if($model->load($request->post()) && $model->validate()){
                if($model->save(false)){
                    $this->alert(Yii::t('common', $isNewRecord ? 'Create Successfully' : 'Update Successfully'), self::ALERT_SUCCESS);
                    $this->operateId = $model->id;
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
     * @return  Admin the loaded model
     * @throws \yii\web\NotFoundHttpException
     */
    public function findModel()
    {
        $id = (int) Yii::$app->request->get('id', 0);
        if($id){
            if(($model = Admin::findOne($id)) !== null){
                return $model;
            }
        }
        $this->exception(Yii::t('common', 'Illegal Request'));
    }
}