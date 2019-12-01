<?php
/*
 * Author: zsw zswemail@qq.com
 */

namespace surface\test;

use surface\form\Form;
use surface\Surface;
use surface\table\Table;

class Test
{
    public static function table()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            return self::data();
        }
        $data = Surface::table(
            function (Table $table)
            {
                $table->search(
                    function (Form $form): array
                    {
                        return [
                            $form::date('add_time', '注册时间')->props(['type' => 'daterange'])->col(['lg' => ['span' => 12]]),
                        ];
                    }
                );

                $table->table(
                    [
                        'description'   => '这是描述描述描述',
                        'url'           => '',   // 数据请求地址
                        'defaultParams' => ['ok' => 'ook'], // 请求数据post携带的参数
                        'topBtn'        => [
                            $table::button('alert', 'alert', ['icon' => 'success'], 'fa fa-circle-thin'),
                            $table::button('page', 'page', ['url' => url('create')], 'fa fa-window-maximize'),
                            $table::button(
                                'submit', 'submit', [
                                'text'    => '确认操作',
                                'url'     => url('edit'),
                                'method'  => 'POST',
                                'refresh' => false,
                            ], 'fa fa-plus'
                            ),
                        ],
                        'operations'    => [
                            $table::button(
                                'confirm', '', [
                                'text'    => '确认操作',
                                'url'     => url('edit'),
                                'method'  => 'POST',
                                'refresh' => true,
                                'params'  => ['id', 'city'],
                            ], 'fa fa-commenting-o'
                            ),
                        ],
                    ]
                );

                $table->column(
                    [
                        ['field' => 'id', 'title' => 'ID', 'type' => 'text', 'sort' => true],
                        $table::text('name', '用户名'),
                        $table::textEdit('tel', '电话'),
                        $table::switchEdit('status', '状态')->edit_url('')->options([0 => '锁定', 1 => '正常']),
                    ]
                );
            }
        );

        return $data->view();
    }

    private static function data()
    {
        $page = $_POST['page'] ?? 1;
        $row_num = $_POST['row_num'] ?? 10;
        $sort_field = $_POST['sort_field'] ?? '';
        $sort_order = $_POST['sort_order'] ?? '';

        $data = [];
        for ($i = 1; $i <= $row_num; $i++)
        {
            $data[] = [
                'id'       => (($page - 1) * $row_num + $i),
                'name'     => 'name_'.(($page - 1) * $row_num + $i),
                'tel'      => '15555555555',
                'status'   => rand(0, 1),
                'add_time' => time() - rand(1, 10000),
            ];
        }

        $data = [
            'list' => $data,
        ];

        return self::show(1, '请求成功', $data);
    }

    private static function show($code, $msg, $data = '')
    {
        return [
            'code' => $code,
            'msg'  => $msg,
            'data' => $data,
        ];

    }

    public static function form()
    {
        $data = Surface::form(
            function (Form $form)
            {
                $form->rule(
                    [
                        $form::uploads('avatar', '头像')->props(
                            [
                                'manageUrl'  => '', // 文件管理地址
                                'action'     => '', // 文件上传地址
                                'uploadType' => 'file', // 文件类型 支持image|file
                            ]
                        ),

                        Form::text("version", "版本号", '1.0.1')->validate(['message' => "版本号格式错误", 'pattern' => "\d+\.\d+\.\d+"]),
                        $form::text('name', '姓名', '')->validate(['required' => 'true', 'message' => '用户名不能为空', 'trigger' => 'blur']),
                        $form::radio('sex', '性别', '1')->addOptions(['1' => '男', '2' => '女', '3' => '其他']),
                        $form::number('age', '年龄', '18'),
                        $form::select('hobby', '爱好')->addOptions(['1' => '唱歌', '2' => '跳舞', '3' => 'rap', '4' => '篮球']),
                        $form::switcher('status', '状态', 1)->addOptions(0, 1),

                        $form::tab(
                            'pic', 'tab', 'upyun', [
                            'children' => [
                                'ali'   => [
                                    'name'     => 'ali',
                                    'title'    => 'ali',
                                    'children' => [
                                        $form::text('appid', 'appId', 'ali'),
                                    ],
                                ],
                                'upyun' => [
                                    'name'     => 'upyun',
                                    'title'    => 'upyun',
                                    'children' => [
                                        $form::text('appid', 'appId', 'upyun')->props(['disabled' => true]),
                                    ],
                                ],
                                'qiniu' => [
                                    'name'     => 'qiniu',
                                    'title'    => 'qiniu',
                                    'children' => [
                                        $form::text('appid', 'appId', 'qiniu'),
                                    ],
                                ],
                            ],
                        ]
                        ),
                    ]
                );
                $form->setSubmitBtn(['innerText' => '提交']);
            }
        );
        return $data->view();
    }

}
