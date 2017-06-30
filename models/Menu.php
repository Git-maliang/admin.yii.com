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
            [['icon'], 'string', 'max' => 32],
            [['name', 'route'], 'string', 'max' => 64],
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
    public function beforeSave($insert)
    {
        if($this->isNewRecord){
            $this->sort = 1000;
            $this->created_at = time();
        }
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    /**
     * 菜单
     * @param int $pid
     * @return array
     */
    public static function childArray($pid = 0)
    {
        return self::find()->select('name')->where(['pid' => $pid])->indexBy('id')->asArray()->column();
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
                $data[$menu['pid']]['items'][$menu['id']]= [
                    'id' => $menu['id'],
                    'name' => $menu['name']
                ];
            }else{
                $data[$menu['id']]['id'] = $menu['id'];
                $data[$menu['id']]['name'] = $menu['name'];
            }
        }
        return $data;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChild()
    {
        return $this->hasMany(AuthItemChild::className(), ['parent' => 'route']);
    }
}
