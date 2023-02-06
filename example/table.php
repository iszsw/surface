<?php

require_once "common.php";

use surface\Component;
use surface\components\Table;
use surface\components\TableColumn;
use surface\Surface;

$surface = new Surface();

$table = (new Table())
    ->vModel(name: "tableApi")
    ->props(
        [
            'columns' => [
                (new TableColumn())->props(['type' => 'selection']),
                (new TableColumn())->props(['label' => '姓名', 'prop' => 'name'])->children((new \surface\components\Input())),
                (new TableColumn())->props(['label' => '年龄', 'prop' => 'age'])->children(
                    [// 4种自定义绑定表格数据格式
                     // 绑定到children
                     (new Component(['el' => 'div', ':children' => ''])),
                     // 当前列字段age提交到{age}位置
                     (new Component(['el' => 'div', ':children' => '年龄：{age}'])),
                     // 自定义处理函数返回字符串显示
                     (new Component(['el' => 'div', ':children' => \surface\Functions::create("return '虚岁：' + row[field]", ['field', 'row', 'prop'])])),
                     // html渲染需要绑定到innerHTML
                     (new Component(['el' => 'span', 'props' => [':innerHTML' => "<b>{name}</b>"]])),
                    ]
                ),
                (new TableColumn())->props(['label' => '状态', 'prop' => 'status'])->children(
                    (new \surface\components\Switcher())->props(
                        [
                            // 预处理修改事件
                            TableColumn::EVENT_CHANGE => [
                                'before'  => \surface\Functions::create("console.log('before')", ['prop', 'data']),
                                'after'   => \surface\Functions::create("console.log('after')", ['prop', 'data', 'res']),
                                'request' => [
                                    'url' => "/api/change.php",
                                ],
                            ],
                        ]
                    )
                ),
                (new TableColumn())->props(['label' => '头像', 'prop' => 'avatar'])->children(
                    (new Component(['el' => 'el-image']))->props([':src' => '', 'style' => ["width" => "50px"]])
                ),
                (new TableColumn())->props(['label' => '来自', 'prop' => 'from'])->children(
                    (new \surface\components\Select())->options(['sz' => '深圳', 'cq' => '重庆', 'sc' => '四川', 'bj' => '北京', 'sh' => '上海'])
                ),
                (new \surface\components\TableColumn())->props(['label' => '地址'])->children(
                    [
                        (new \surface\components\TableColumn())->props(['label' => '地址', 'minWidth' => "160px", 'prop' => 'address']),
                        (new \surface\components\TableColumn())->props(['label' => '收货人', 'prop' => 'name'])->children(
                            (new \surface\components\Editable()),
                        ),
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
                                // 通过:注入当前列到方法
                                ':onClick' => \surface\Functions::create(
                                    "return function(){ console.log(row) }",
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
                'loadAfter' => \surface\Functions::create($surface->data() . ".total.value = res.data.total", ['res'])
            ]
        ]
    )->children(
        [
            // table 预留的插槽
            (new \surface\components\Form())->slot('top')->props(
                [
                    'columns' => [
                        (new Component('button'))->col(['span' => null])->props(
                            [
                                "type"    => "info",
                                "onClick" => \surface\Functions::create("{$surface->data()}.tableApi.value.load();"),
                            ]
                        )->children([(new Component('icon'))->props(['icon' => 'Refresh']), " 刷新"]),

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
                        'props'        => ['label-width' => 0],
                        'submitBefore' => \surface\Functions::create("{$surface->data()}.tableApi.value.load(data, true);return false", ['data'])
                    ],
                ]
            ),
            (new Component('h2'))->slot(['header'])->ref("total", 0)->children(\surface\Functions::create("return '总共' + ".$surface->data().".total.value + '条数据'")),
            (new Component('i'))->slot(['append'])->children("append-slot"),
            (new Component('i'))->slot(['footer'])->children("我是footer-slot"),

        ]
    );


echo $table->view($surface);


