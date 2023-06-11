<?php


require_once "common.php";

use surface\Component;
use surface\components\Button;
use surface\components\Form;
use surface\components\Number;
use surface\components\Popconfirm;
use surface\components\Table;
use surface\components\TableColumn;
use surface\components\Input;
use surface\Surface;
use surface\Functions;

/**
 * 增删改查使用
 */

class Curd
{

    private Surface $surface;

    public function __construct() {
        $this->surface = new Surface();
    }

    private function table(){
        $table = (new Table())
            ->vModel(name: "tableApi")
            ->props(
                [
                    'columns' => [
                        (new TableColumn())->props(['type' => 'selection']),
                        (new TableColumn())->props(['label' => '头像', 'prop' => 'avatar'])->children(
                            (new Component(['el' => 'el-image']))->props([':src' => '', 'style' => ["width" => "50px"]])
                        ),
                        (new TableColumn())->props(['label' => '地址'])->children(
                            [
                                (new TableColumn())->props(['label' => '地址', 'minWidth' => "160px", 'prop' => 'address']),
                                (new TableColumn())->props(['label' => '收货人', 'prop' => 'name']),
                            ]
                        ),
                        (new TableColumn())->props(['label' => '操作'])->children(
                            [
                                (new Popconfirm())
                                    ->props(['title' => "确认删除？"])
                                    ->onConfirm(["url" => "/api/change.php", 'method' => 'post', 'data' => ["status" => "OK", "id"]], "{$this->surface->data()}.tableApi.value.load()")
                                    ->onCancel(["url" => "/api/change.php", 'method' => 'post', 'data' => ["status" => "NO", "id"]], "{$this->surface->data()}.tableApi.value.load()")
                                    ->reference('删除'),

                                (new Button())->props(
                                    [
                                        'type'     => 'primary',
                                        'size'      => 'small',
                                        // 通过:注入当前列到方法
                                        ':onClick' => Functions::create("
                                return function(){
                                   {$this->surface->data()}.formData.value = Surface.cloneDeep(row) // 设置form数据
                                   {$this->surface->data()}.dialogRef.value = true // 显示form弹窗
                                }
                                ",['filed', 'row']),
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
                    $this->search()->slot('top'),
                    (new Component('div'))->slot(['header'])->children(
                        [
                            (new Component('el-button'))->props(
                                [
                                    "type"   => "primary",
                                    // 获取选中项
                                    "onClick" => Functions::create(
                                        <<<HTML
alert(JSON.stringify({$this->surface->data()}.tableApi.value.getSelectionByField('id')))
HTML,
                                    )
                                ]
                            )->children("获取选中"),
                            (new Component('el-button'))->props(
                                [
                                    "type"   => "primary",
                                    "onClick" => Functions::create(
                                        <<<HTML
{$this->surface->data()}.formData.value = {}
{$this->surface->data()}.dialogRef.value = true
HTML,
                                    )
                                ]
                            )->children("新增"),
                        ]
                    )
                ]
            );


        $this->surface->append($table);
    }

    private function search(): Component
    {
        return (new Form())->props(
            [
                'columns' => [
                    (new Input(['label' => "Input", 'name' => 'input']))->col(['span' => 6]),
                    (new Number(['label' => "number1", 'name' => 'number1']))->col(['span' => 6]),
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
                    // 阻止提交 并将数据传入table搜索
                    'submitBefore' => Functions::create("{$this->surface->data()}.tableApi.value.load(data, true);return false", ['data'])
                ],
            ]
        );
    }

    private function form(){

        $form = (new Form())
            ->vModel(name: "formApi")
            ->vModel([], 'data', 'formData')
            ->props(
                [
                    'columns' => [
                        (new Input(['label' => "姓名", 'name' => 'name']))
                            ->rules(['required' => true, 'message' => '请输入名字!']),
                        (new Number(['label' => "年龄", 'name' => 'age', 'value' => 0])),
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
                        // 隐藏弹窗 提示成功
                        'submitAfter' => Functions::create("{$this->surface->data()}.dialogRef.value = false;ElementPlus.ElMessage({type: 'success',message: '保存成功'})")
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

        $this->surface->append($dialog);
    }


    public function index(){

        $this->form();

        $this->table();

        return $this->surface->view();
    }
}

echo (new Curd())->index();




