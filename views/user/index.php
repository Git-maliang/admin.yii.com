
<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<!--<ul id="tree"></ul>-->
<?php
$data = [
    [
        'name' => '一级1', // 节点名称
        'spread' => true, // 是否是展开状态，true为展开状态
        'checkboxValue' => 1, // 复选框的值
        'checked' => true, // 复选框默认是否选中
        'children' => [ // 子集
            [
                'name' => '二级11', // 节点名称
                'spread' => true, // 是否是展开状态，true为展开状态
                'checkboxValue' => 11, // 复选框的值
                'checked' => true, // 复选框默认是否选中
            ],
            [
                'name' => '二级12',
                'spread' => true,
                'checkboxValue' => 12,
                'checked' => true,
                'children' => [ // 子集
                    [
                        'name' => '三级121',
                        'checkboxValue' => 121,
                        'checked' => true,
                    ],
                    [
                        'name' => '三级122',
                        'checkboxValue' => 122,
                        'checked' => true,
                    ],
                ],
            ],
        ],
    ],
    [
        'name' => '一级2',
        'spread' => true,
        'checkboxValue' => 2,
        'checked' => true,
        'children' => [
            [
                'name' => '二级21',
                'spread' => true,
                'checkboxValue' => 21,
                'checked' => true,
                'children' => [
                    [
                        'name' => '三级211',
                        'checkboxValue' => 211,
                        'checked' => true,
                    ],
                    [
                        'name' => '三级212',
                        'checkboxValue' => 212,
                        'checked' => true,
                    ],
                    [
                        'name' => '三级213',
                        'checkboxValue' => 213,
                        'checked' => false,
                    ],
                ],
            ],
            [
                'name' => '二级22',
                'spread' => true,
                'checkboxValue' => 22,
                'checked' => true,
                'children' => [
                    [
                        'name' => '三级221',
                        'checkboxValue' => 221,
                        'checked' => true,
                    ],
                    [
                        'name' => '三级222',
                        'checkboxValue' => 222,
                        'checked' => true,
                    ],
                ],
            ],
        ],
    ],
];
//\app\components\widgets\Tree::widget(['data' => $data]);
?>
