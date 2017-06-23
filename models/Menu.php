<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%menu}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $pid
 * @property string $icon
 * @property string $route
 * @property integer $sort
 * @property integer $created_at
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'sort', 'created_at'], 'integer'],
            [['name'], 'string', 'max' => 128],
            [['icon'], 'string', 'max' => 32],
            [['route'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '菜单名称',
            'pid' => '父级ID',
            'icon' => '图标',
            'route' => '路由规则',
            'sort' => '排序',
            'created_at' => '创建时间',
        ];
    }
}
