<?php


require_once "common.php";

use surface\Component;
use surface\components\Form;
use surface\components\Table;
use surface\components\TableColumn;
use surface\Surface;

/**
 * 增删改查使用
 */

$surface = new Surface();

// 表格
$table = (new Table())
    ->vModel(name: "tableApi")
    ->props(
        [
            'columns' => [
                (new TableColumn())->props(['type' => 'selection']),
                (new TableColumn())->props(['label' => '头像', 'prop' => 'avatar'])->children(
                    (new Component(['el' => 'el-image']))->props([':src' => '', 'style' => ["width" => "50px"]])
                ),
                (new \surface\components\TableColumn())->props(['label' => '地址'])->children(
                    [
                        (new \surface\components\TableColumn())->props(['label' => '地址', 'minWidth' => "160px", 'prop' => 'address']),
                        (new \surface\components\TableColumn())->props(['label' => '收货人', 'prop' => 'name']),
                    ]
                ),
                (new TableColumn())->props(['label' => '操作'])->children(
                    [
                        (new \surface\components\Popconfirm())
                            ->props(['title' => "确认删除？"])
                            ->onConfirm(["url" => "/api/change.php", 'method' => 'post', 'data' => ["status" => "OK", "id"]], "{$surface->data()}.tableApi.value.load()")
                            ->onCancel(["url" => "/api/change.php", 'method' => 'post', 'data' => ["status" => "NO", "id"]], "{$surface->data()}.tableApi.value.load()")
                            ->reference('删除'),

                        (new \surface\components\Button())->props(
                            [
                                'type'     => 'primary',
                                'size'      => 'small',
                                // 通过:注入当前列到方法
                                ':onClick' => \surface\Functions::create("
                                return function(){
                                   {$surface->data()}.formData.value = row // 设置form数据
                                   {$surface->data()}.dialogRef.value = true // 显示form弹窗
                                }
                                ",
                                                                         ['filed', 'row']
                                ),
                            ]
                        )->children("编辑"),
                    ]
                ),
            ],
            'options' => [
                'config'          => [
                    'responseKeys'        => [
                        'code' => 'code',
                        'data' => 'data',
                        'msg'  => 'msg',
                    ],
                    'responseSuccessCode' => 0,
                ],
                'request'         => [
                    'url'  => '/api/lists.php',
                    'data' => [
                        'append' => '这是附加参数',
                    ],
                ],
                'paginationProps' => [
                    'background'          => true,
                    'hide-on-single-page' => true,
                    'default-page-size'   => 2,
                ],
            ]
        ]
    )->children(
        [
            (new \surface\components\Form())->slot('top')->props(
                [
                    'columns' => [
                        (new \surface\components\Input(['label' => "Input", 'name' => 'input']))->col(['span' => 6]),
                        (new \surface\components\Number(['label' => "number1", 'name' => 'number1']))->col(['span' => 6]),
                    ],
                    'options' => [
                        "col" => ['span' => 6],
                        "submit" => [
                            'props' => [
                                'type' => 'primary'
                            ],
                            'children' => "搜索"
                        ],
                        "row" => [
                            "gutter" => 10 // 偏移 10px
                        ],
                        'submitBefore' => \surface\Functions::create("{$surface->data()}.tableApi.value.load(data, true);return false", ['data'])
                    ],
                ]
            ),
            (new Component('div'))->slot(['header'])->children(
                [
                    (new Component('el-button'))->props(
                        [
                            "type"   => "primary",
                            "onClick" => \surface\Functions::create(
                                <<<HTML
alert(JSON.stringify({$surface->data()}.tableApi.value.getSelectionByField('id')))
HTML,
                            )
                        ]
                    )->children("获取选中"),
                    (new Component('el-button'))->props(
                        [
                            "type"   => "primary",
                            "onClick" => \surface\Functions::create(
                                <<<HTML
{$surface->data()}.formData.value = {}
{$surface->data()}.dialogRef.value = true
HTML,
                            )
                        ]
                    )->children("新增"),
                ]
            )
        ]
    );

$form = (new Form())
    ->vModel(name: "formApi")
    ->vModel([], 'data', 'formData')
    ->props(
        [
            'columns' => [
                (new \surface\components\Input(['label' => "姓名", 'name' => 'name']))
                    ->rules(['required' => true, 'message' => '请输入名字!']),
                (new \surface\components\Number(['label' => "年龄", 'name' => 'age', 'value' => 0]))
                    ->suffix("加到2有惊喜"),
            ],
            'options' => [
                'props'        => [
                    'label-width' => '100px',
                ],
                'row'          => [
                    'justify' => 'start',
                ],
                'col'          => [
                    'span' => 12,
                ],
                // 提交成功后回调事件，自定义submit事件 不会触发
                'request'      => [
                    'url'     => '/api/change.php',
                    'method'  => 'post',
                    'headers' => [
                        'X-HEADER' => 'header',
                    ],
                    'data'    => [
                        'append' => '这是附加参数',
                    ],
                ],
                'submit'       => [
                    'props'    => [
                        'type' => 'success',
                    ],
                    "children" => '确认',
                ],
            ],
        ]
    );

$dialog = (new Component('el-dialog'))
    ->vModel(false, name: 'dialogRef')
    ->props(
        [
            'title'            => '修改',
            'destroy-on-close' => '',
        ]
    )->children($form);

$surface->append($dialog);
$surface->append($table);

echo $surface->view();


