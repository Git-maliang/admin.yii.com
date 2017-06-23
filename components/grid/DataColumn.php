<?php
/**
 * Created by PhpStorm.
 * User: M
 * Date: 17/4/13
 * Time: 上午9:31
 */

namespace app\components\grid;


class DataColumn extends \yii\grid\DataColumn
{
    public $encodeLabel = false;
    public $enableSorting = false;
    public $headerOptions = ['class'=>'center'];
    public $contentOptions = ['class' => 'center'];
}