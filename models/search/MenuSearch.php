<?php
/**
 * Created by PhpStorm.
 * User: M
 * Date: 17/6/23
 * Time: 上午10:37
 */

namespace app\models\search;


use app\models\Menu;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;

class MenuSearch extends Menu
{
    public function search(Array $params)
    {
        $query = self::find();
        $pageSize = ArrayHelper::getValue($params, 'per-page', 10);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $pageSize,
            ],
        ]);
        $this->load($params);
        if(!$this->validate()){
            return $dataProvider;
        }

        $query->orderBy(['created_at' => SORT_DESC]);
        return $dataProvider;
    }
}