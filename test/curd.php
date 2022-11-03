<?php

require_once __DIR__."/../../../autoload.php";

use surface\Component;
use surface\components\TableColumn;
use surface\Document;
use surface\Functions;

/**
 * Curd 工具使用
 */

$curd = (new \surface\tools\Curd());

$curd->table(
    [
        (new \surface\components\TableColumn())->props(['type' => 'selection']),
        (new \surface\components\TableColumn())->props(['label' => '姓名', 'prop' => 'name'])->children((new \surface\components\Input())),
        (new \surface\components\TableColumn())->props(['label' => '年龄', 'prop' => 'age'])->children(
            [// 4种自定义绑定表格数据格式
             // 绑定到children
             (new Component(['el' => 'div', ':children' => ''])),
             // {age}替换
             (new Component(['el' => 'div', ':children' => '年龄：{age}'])),
             // 自定义处理函数
             (new Component(['el' => 'div', ':children' => Functions::create("return '虚岁：' + row[field]", ["field", "row", "prop"])])),
             // html渲染需要绑定到innerHTML
             (new Component(['el' => 'span', 'props' => [':innerHTML' => "<b>{name}</b>"]])),
            ]
        ),
        (new \surface\components\TableColumn())->props(['label' => '状态', 'prop' => 'status'])->children(
            (new \surface\components\Switcher())->props([TableColumn::EVENT_CHANGE => $curd->changeEvent("/api/change.php")])
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
                        ':onClick' => Functions::create(
                            "return function(){
                                {$curd->getFormDataApi()} = row // 设置formData数据
                                {$curd->getDialogApi()} = true // 显示form弹窗
                            }",
                            ['filed', 'row']
                        ),
                    ]
                )->children("编辑"),
            ]
        ),
    ],
    [
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
)->search(
        [
            (new \surface\components\Input(['label' => "Input", 'name' => 'input']))->col(['span' => 6]),
            (new \surface\components\Number(['label' => "number1", 'name' => 'number1']))->col(['span' => 6]),
        ], [
            "row" => [
                "gutter" => 10 // 偏移 10px
            ],
        ]
    )
    ->form(
        [
            (new \surface\components\Input(['label' => "姓名", 'name' => 'name']))
                ->rules(['required' => true, 'message' => '请输入名字!']),
            (new \surface\components\Number(['label' => "年龄", 'name' => 'age', 'value' => 0]))
                ->suffix("加到2有惊喜"),
        ],
        [
            'props'        => [
                'label-width' => '100px',
            ],
            'row'          => [
                'justify' => 'start',
            ],
            'col'          => [
                'span' => 12,
            ],
            // 提交前返回 false 阻止提交
            'submitAfter'  => Functions::create("{$curd->getDialogApi()} = false;{$curd->getTableApi()}.load()", ["data", "res"]),
            // 提交成功后回调事件，自定义submit事件 不会触发
            'request'      => [
                'url'     => '/api/change.php',
                'method'  => 'post',
            ],
            'submit'       => [
                'props'    => [
                    'type' => 'success',
                ],
                "children" => '确认',
            ],
            //            'reset' => null, // 不需要reset可以设置为 null
        ]
    );

$curd->table->appendChild(
    [
        (new Document('template'))->attrs(['#header'])->appendChild(
            (new Document('el-button'))->binds(
                [
                    "submitSel" => Functions::create(
                        <<<HTML
Surface.request({url: '/api/change.php', method: 'POST',data: {id: {$curd->getTableApi()}.getSelectionByField('id')}}).then(res => {
ElMessage.success(res.msg)
{$curd->getTableApi()}.load()
})
HTML,
                    ),
                ]
            )->attrs(
                [
                    "@click" => "submitSel",
                    "type"     => "primary",
                ]
            )->appendChild("提交")
        ),
    ]
);


echo $curd->view(); // 显示页面


