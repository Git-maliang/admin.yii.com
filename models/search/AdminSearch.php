<?php

namespace app\models\search;

use yii\base\Model;
use app\models\Admin;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use app\components\helpers\MatchHelper;

/**
 * Class MenuSearch
 * @package app\models\search
 */
class AdminSearch extends Admin
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_id', 'mobile', 'status'], 'integer', 'message'=>'{attribute}必须是整数。'],
            [['username'], 'string', 'max' => 20, 'tooLong' => '{attribute}不能超过20个字符。'],
            [['real_name'], 'string', 'min'=>2, 'max' => 4, 'tooShort' => '{attribute}不能小于2个汉字。', 'tooLong' => '{attribute}不能超过4个汉字。'],
            [['real_name'], 'match', 'pattern' => MatchHelper::$chinese, 'message' => '{attribute}为2到4个汉字。'],
            [['mobile'], 'match', 'pattern' => MatchHelper::$mobile, 'message' => '{attribute}格式不正确。'],
            [['email'], 'string', 'max' => 50, 'tooLong' => '{attribute}不能超过50个字符。'],
            [['email'], 'email', 'message' => '{attribute}格式不正确。'],
            [['create_id'], 'in', 'range' => array_keys(Admin::adminArray()) ,'message' => '{attribute}不在有效范围内。'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     */
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

        $query->andFilterWhere([
            'username' => $this->username,
            'real_name' => $this->real_name,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'create_id' => $this->create_id,
            'status' => $this->status
        ]);

        return $dataProvider;
    }
}
