<?php
/**
 * Created by PhpStorm.
 * User: M
 * Date: 17/6/23
 * Time: 上午10:37
 */

namespace app\models\search;

use yii\base\Model;
use app\models\Menu;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;

class MenuSearch extends Menu
{
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[Model::SCENARIO_DEFAULT] = array_merge(
            $scenarios[Model::SCENARIO_DEFAULT],
            ['name']
        );
        return $scenarios;
    }

    public function search(Array $params)
    {
        $query = self::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => ArrayHelper::getValue($params, 'per-page', 10)
            ],
        ]);
        $this->load($params);
        if(!$this->validate()) {
            return $dataProvider;
        }

        if($this->name){
            $query->andFilterWhere(['name' => $this->name]);
        }

        $query->orderBy(['created_at' => SORT_DESC]);
        return $dataProvider;
    }
}