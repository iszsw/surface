<?php

require_once __DIR__."/../../../autoload.php";

use surface\Surface;
use surface\Component;
use surface\documents\Table;

/**
 * 表格
 */
$surface = new Surface();

$table = (new Table())->vModel()->binds(
    [
        'columns' => [
            (new \surface\components\TableColumn())->props(['type' => 'selection']),
            (new \surface\components\TableColumn())->props(['label' => '姓名', 'prop' => 'name'])->children((new \surface\components\Input())),
            (new \surface\components\TableColumn())->props(['label' => '年龄', 'prop' => 'age'])->children(
                [// 4种自定义绑定表格数据格式
                 // 绑定到children
                 (new Component(['el' => 'div', ':children' => ''])),
                 // {age}替换
                 (new Component(['el' => 'div', ':children' => '年龄：{age}'])),
                 // 自定义处理函数
                 (new Component(['el' => 'div', ':children' => \surface\Functions::create("return '虚岁：' + row[field]", ["field", "row", "prop"])])),
                 // html渲染需要绑定到innerHTML
                 (new Component(['el' => 'span', 'props' => [':innerHTML' => "<b>{name}</b>"]])),
                ]
            ),
            (new \surface\components\TableColumn())->props(['label' => '状态', 'prop' => 'status'])->children(
                (new \surface\components\Switcher())->props(
                    [
                        // 预处理修改事件
                        \surface\components\TableColumn::EVENT_CHANGE => [
                            'before'  => \surface\Functions::create("console.log('before')", ['prop', 'data']),
                            'after'   => \surface\Functions::create("console.log('after')", ['prop', 'data', 'res']),
                            'request' => [
                                'url' => "/api/change.php",
                            ],
                        ],
                    ]
                )
            ),
            (new \surface\components\TableColumn())->props(['label' => '头像', 'prop' => 'avatar'])->children(
                (new Component(['el' => 'el-image']))->props([':src' => '', 'style' => ["width" => "50px"]])
            ),
            (new \surface\components\TableColumn())->props(['label' => '来自', 'prop' => 'from'])->children(
                (new \surface\components\Select())->options(['sz' => '深圳', 'cq' => '重庆', 'sc' => '四川', 'bj' => '北京', 'sh' => '上海'])
            ),
            (new \surface\components\TableColumn())->props(['label' => '地址', 'prop' => 'address'])->children(
                [
                    (new \surface\components\Editable()),
                ]
            ),
            (new \surface\components\TableColumn())->props(['label' => '操作'])->children(
                [
                    (new \surface\components\Popconfirm())
                        ->onConfirm(["url" => "/api/change.php", 'method' => 'post', 'data' => ["status" => "OK", "id"]])
                        ->onCancel(["url" => "/api/change.php", 'method' => 'post', 'data' => ["status" => "NO", "id"]])
                        ->reference('删除')->props(['title' => '确认删除？']),
                    (new \surface\components\Button())->props(
                        [
                            'type'     => 'primary',
                            // 通过:注入当前列到方法
                            ':onClick' => \surface\Functions::create(
                                "return function(){
                                console.log(row)
                            }",
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
        ],
        'search'  => [
            'columns' => [
                (new \surface\components\Input(['label' => "Input", 'name' => 'input']))->col(['span' => 6]),
                (new \surface\components\Number(['label' => "number1", 'name' => 'number1']))->col(['span' => 6]),
            ],
            'options' => [
                "row" => [
                    "gutter" => 10 // 偏移 10px
                ],
            ],
        ],
    ]
)->attrs(
    [
        ':columns' => 'columns',
        ':options' => 'options',
        ':search'  => 'search',
    ]
)->appendChild(
    [
        (new \surface\Document('template'))->attrs(['#top'])->appendChild("<b>我是top-slot</b>"),
        (new \surface\Document('template'))->attrs(['#header'])->appendChild("<b>我是header-slot</b>"),
        (new \surface\Document('template'))->attrs(['#append'])->appendChild("<b>我是append-slot</b>"),
        (new \surface\Document('template'))->attrs(['#footer'])->appendChild("<b>我是footer-slot</b>"),
    ]
);
// 加入到surface
$surface->append($table);

// 页面
echo $surface->view();
