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
            [['name', 'route'], 'required'],
            [['pid', 'sort', 'created_at'], 'integer'],
            [['name'], 'string', 'max' => 128],
            [['icon'], 'string', 'max' => 32],
            [['route'], 'string', 'max' => 64],
            [['pid',], 'default', 'value' => 0],
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
            'pid' => '所属菜单',
            'icon' => '图标',
            'route' => '路由规则',
            'sort' => '排序',
            'created_at' => '创建时间',
        ];
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        if($this->isNewRecord){
            $this->sort = $this->id;
            $this->created_at = time();
        }
        parent::afterSave($insert, $changedAttributes);
    }

    /**
     * 一级菜单
     * @return array
     */
    public static function pidArray()
    {
        return self::find()->select('name')->where(['pid' => 0])->indexBy('id')->asArray()->column();
    }

    /**
     * 获取全部菜单
     * @return array
     */
    public static function getMenus()
    {
        $data = [];
        $menus = self::find()->select(['id', 'pid', 'name'])->orderBy(['pid' => SORT_ASC,'sort' => SORT_ASC])->asArray()->all();
        foreach($menus as $menu){
            if($menu['pid']){
                $data[$menu['pid']]['items'][$menu['id']]['name'] = $menu['name'];
            }else{
                $data[$menu['id']]['name'] = $menu['name'];
            }
        }
        return $data;
    }
}
