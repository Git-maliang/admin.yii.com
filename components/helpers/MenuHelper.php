<?php
/**
 * Created by PhpStorm.
 * User: M
 * Date: 17/6/22
 * Time: 下午1:36
 */

namespace app\components\helpers;

use Yii;
use app\models\Menu;
use yii\base\Widget;

class MenuHelper extends Widget
{
    const CACHE_MENU = 'cache_menu_';

    /**
     * 获取分配的菜单
     * @return array|mixed
     */
    public static function getAssignedMenu()
    {
        $cache = Yii::$app->cache;
        $cacheKey = self::CACHE_MENU . Yii::$app->user->id;
        $items = $cache->get($cacheKey);
        if($items === false){
            $items = self::handleMenu();
            $cache->set($cacheKey, $items, 1800);
        }
        return $items;
    }

    /**
     * 处理菜单
     * @return array
     */
    protected static function handleMenu()
    {
        $menus = Menu::find()->select(['id', 'pid', 'name', 'route', 'icon'])->orderBy(['pid' => SORT_ASC,'sort' => SORT_ASC])->asArray()->all();
        $data = [];
        foreach ($menus as $menu){
            if($menu['pid']){
                $data[$menu['pid']]['items'][] = [
                    'label' => $menu['name'],
                    'url' => $menu['route']
                ];
            }else{
                $data[$menu['id']]['label'] = $menu['name'];
                $data[$menu['id']]['icon'] = $menu['icon'];
            }
        }
        return $data;
    }

}