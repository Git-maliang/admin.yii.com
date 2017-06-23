<?php
/**
 * Created by PhpStorm.
 * User: M
 * Date: 17/4/13
 * Time: 上午9:45
 */

namespace app\components\i18n;

use Yii;
use yii\helpers\Html;

/**
 * Class Formatter
 * @package app\components\i18n
 */
class Formatter extends \yii\i18n\Formatter
{
    public $nullDisplay = '';

    /**
     * Ip转换
     * @param $value
     * @return string
     */
    public function asIp($value)
    {
        if ($value === null) {
            return $this->nullDisplay;
        }
        return $value ? long2ip($value) : '';
    }

    /**
     * 从数组取出值
     * @param $value
     * @param $items
     */
    public function asItems($value, $items){
        if ($value === null) {
            return $this->nullDisplay;
        }
        return isset($items[$value]) && $items[$value] ? $items[$value] : $this->nullDisplay;
    }

    /**
     * 遮挡字符串中间的字，以某个字符代替比如131***6789
     * @param $value
     * @return string
     */
    public function asMobile($value){
        if ($value === null) {
            return $this->nullDisplay;
        }
        return $value ? substr_replace($value, str_repeat('*', 4), 4, 4) : $this->nullDisplay;
    }

    /**
     * ICON
     * @param $value
     */
    public function asIcon($value)
    {
        if ($value === null) {
            return $this->nullDisplay;
        }
        return $value ?  Html::tag('i', null, ['class' => "fa $value"]) . ' ' . $value : $this->nullDisplay;
    }

    /**
     * 时间格式化
     * @param \DateTime|int|string $value
     * @param null $format
     * @return string
     */
    public function asDateTime($value, $format = null)
    {
        if ($value === null) {
            return $this->nullDisplay;
        }
        return $value ? date('Y-m-d H:i:s', $value) : '';
    }
}