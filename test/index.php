<?php

require_once __DIR__."/../../../autoload.php";

use surface\Surface;
use surface\Component;
use surface\Document;
use surface\documents\Table;

/**
 * 表格表单联合使用
 */

$surface = new Surface();
$id = $surface->id();

$surface->addStyle("
<style>
#{$surface->id()} {
    width: 1000px;
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    margin: auto;
    padding: 10px;
}
</style>
");

$dialog = (new Document('el-dialog'))->vModel(false);// 自定义dialog弹窗
$table = (new Table())->vModel();// 自定义Table

$surfaceApi = "Surface.".$surface->id();// 在全局获取当前Surface实例
$dialogVModel = $dialog->getVModel(); // 获取dialog的VModel
$tableApi = $surfaceApi.".".$table->getVModel();// 获取table组件
$tableForm = (new \surface\documents\Form())
    ->vModel(null, 'data')// v-model绑定的数据才支持双向绑定 自定义名data
    ->attrs( // attrs会原样绑定标签上
        [
            ':columns' => 'formColumns',
            ':options' => 'formOptions',
        ]
    )
    ->binds( // binds的数据都是全局的  注意命名冲突
        [
            'formColumns' => [
                (new \surface\components\Input(['label' => "姓名", 'name' => 'name']))
                    ->rules(['required' => true, 'message' => '请输入名字!']),
                (new \surface\components\Number(['label' => "年龄", 'name' => 'age', 'value' => 0]))
                    ->suffix("加到2有惊喜"),
            ],
            'formOptions' => [
                'props'        => [
                    'label-width' => '100px',
                ],
                'row'          => [
                    'justify' => 'start',
                ],
                'col'          => [
                    'span' => 12,
                ],
                'submitBefore' => \surface\Functions::create("console.log('submitBefore')", ["data"]),
                // 提交前返回 false 阻止提交
                'submitAfter'  => \surface\Functions::create("{$surfaceApi}.{$dialogVModel}.value = false;$tableApi.value.load()", ["data", "res"]),
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
                //            'reset' => null, // 不需要reset可以设置为 null
            ],
        ]
    );

$dialog->attrs(
    [
        'title'            => '修改',
        'destroy-on-close' => null,// 设置值为null 标签上只显示名字
    ]
)->appendChild($tableForm); // 表单页面加入到弹窗中

$surface->append($dialog); // 将标签加入到Surface
$table->binds(
    [
        'columns' => [
            (new \surface\components\TableColumn())->props(['type' => 'expand', 'prop' => 'address'])->children(
                [
                 (new Component(['el' => 'div', ':children' => ''])),
                ]
            ),
            (new \surface\components\TableColumn())->props(['type' => 'selection']),
            (new \surface\components\TableColumn())->props(
                [
                    'minWidth' => "120px",
                    'label' => '姓名',
                    'prop' => 'name',
                    'sortable'=>true,
                    'column-key' => 'name', // 进行filter筛选必须加入column-key
                    'filters' => [["text" => "a", "value" => "aa"], ["text" => "b", "value" => "bb"]]])->children((new \surface\components\Input())),
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
                            'before'  => \surface\Functions::create("console.log('before')"),
                            'after'   => \surface\Functions::create($tableApi.".value.load();", ['prop', 'data', 'res']),
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
            (new \surface\components\TableColumn())->props(['label' => '地址'])->children(
                [
                    (new \surface\components\TableColumn())->props(['label' => '地址', 'minWidth' => "160px", 'prop' => 'address']),
                    (new \surface\components\TableColumn())->props(['label' => '收货人', 'prop' => 'name']),
                ]
            ),
            (new \surface\components\TableColumn())->props(
                [
                    'label' => '操作',
                    'fixed' => "right",
                    'minWidth' => "160px"
                ])->children(
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
                                $surfaceApi.{$tableForm->getVModel('data')}.value = row // 设置form数据
                                $surfaceApi.$dialogVModel.value = true // 显示form弹窗
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
        (new Document('template'))->attrs(['#top'])->appendChild("<b>我是top-slot</b>"),
        (new Document('template'))->attrs(['#header'])->appendChild(
            [(new Document('el-button'))->binds(
                [
                    "submitSel" => \surface\Functions::create(
                        <<<HTML
Surface.request({url: '/api/change.php', method: 'POST',data: {id: $tableApi.value.getSelectionByField('id')}}).then(res => {
ElMessage.success(res.msg)
$tableApi.value.load()
})
HTML,
                    ),
                    //$surfaceApi.$dialogVModel.value = true
                ]
            )->attrs(
                [
                    "@click" => "submitSel",
                    "type"     => "primary",
                ]
            )->appendChild("提交"),
             "<b>我是append-slot</b>"
             ]
        ),
        (new Document('template'))->attrs(['#append'])->appendChild("<b>我是append-slot</b>"),
        (new Document('template'))->attrs(['#footer'])->appendChild("<b>我是footer-slot</b>"),
    ]
);
$surface->append($table); // 将标签加入到Surface

//dd($surface->display());

echo $surface->view(); // 显示页面


