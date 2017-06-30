<?php
/**
 * Created by PhpStorm.
 * User: M
 * Date: 17/4/13
 * Time: 上午10:52
 */

namespace app\components\grid;

use Yii;
use yii\helpers\Html;

class ActionColumn extends \yii\grid\ActionColumn
{
    public $module;
    public $header = '操作';
    public $headerOptions = ['class' => 'center'];
    public $contentOptions = ['class' => 'center'];
    public $template = '{view} {update} {delete}';
    /**
     * Initializes the default button rendering callbacks.
     */
    protected function initDefaultButtons()
    {
        $this->initDefaultButton('view', 'search-plus');
        $this->initDefaultButton('update', 'pencil');
        $this->initDefaultButton('delete', 'trash');
        $this->initDefaultButton('auth', 'cog');
    }

    /**
     * Initializes the default button rendering callback for single button
     * @param string $name Button name as it's written in template
     * @param string $iconName The part of Bootstrap glyphicon class that makes it unique
     * @param array $additionalOptions Array of additional options
     * @since 2.0.11
     */
    protected function initDefaultButton($name, $iconClass, $additionalOptions = [])
    {
        if (!isset($this->buttons[$name]) && strpos($this->template, '{' . $name . '}') !== false) {
            $this->buttons[$name] = function ($url, $model, $key) use ($name, $iconClass, $additionalOptions) {
                if(isset($model->visible) && $model->visible){
                    return '';
                }
                switch ($name) {
                    case 'view':
                        $title = '查看' . $this->module;
                        $this->buttonOptions = ['class' => 'blue'];
                        break;
                    case 'update':
                        $title = '更新' . $this->module;
                        $this->buttonOptions = ['class' => 'green'];
                        break;
                    case 'delete':
                        $title = '删除'. $this->module;
                        $this->buttonOptions = ['class' => 'red'];
                        break;
                    case 'auth':
                        $title = $this->module . '授权';
                        $this->buttonOptions = ['class' => 'orange'];
                        break;
                    default:
                        $title = ucfirst($name);
                }

                $options = array_merge(['title' => $title], $name == 'delete' ? [] : ['target' => '_blank' ] , $additionalOptions, $this->buttonOptions);
                
                $icon = Html::tag('i', '', ['class' => "fa fa-{$iconClass} bigger-130 mr-5"]);
                return Html::a($icon, [$url], $options);
            };
        }
    }
}