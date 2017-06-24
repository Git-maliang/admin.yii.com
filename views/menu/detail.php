<?php

use app\components\widgets\DetailView;

/* @var $model \app\models\Menu */

$this->title = '菜单详情';
?>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'name',
        'icon:icon',
        'route',
        'sort',
        'created_at:datetime'
    ]
]);?>
