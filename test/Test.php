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

        return Surface::table(
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
                            $table::button('page', 'page', ['url' => '/create'], 'fa fa-window-maximize'),
                            $table::button(
                                'submit', 'submit', [
                                'text'    => '确认操作',
                                'url'     => '/edit',
                                'method'  => 'POST',
                                'refresh' => false,
                            ], 'fa fa-plus'
                            ),
                        ],
                        'operations'    => [
                            $table::button(
                                'confirm', '', [
                                'text'    => '确认操作',
                                'url'     => '/edit',
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

        return self::show(0, '请求成功', $data);
    }

    /**
     *
     * @param        $code 0成功 >0失败
     * @param        $msg
     * @param string $data
     *
     * @return string
     */
    private static function show($code, $msg, $data = '')
    {
        return json_encode([
                               'code' => $code,
                               'msg'  => $msg,
                               'data' => $data,
                           ], JSON_UNESCAPED_UNICODE);

    }

    public static function form()
    {
        return Surface::form(
            function (Form $form)
            {
                // 在实例化之前注册全局默认配置
                Form::global(
                    [
                        'upload' => [
                            'manageShow' => true,    // 图片管理
                            'manageUrl'  => '',    // 文件管理地址
                            'action'     => '',    // 文件上传地址
                            'uploadType' => 'image', // 文件类型 支持image|file
                            'multiple'   => false,
                            'limit'      => 1,
                        ],
                        'uploads' => [ // uploads继承自upload 将覆盖upload配置
                                       'multiple' => true,
                                       'limit'    => 9,
                        ],
                        'frame'   => [
                            'icon'   => 'el-icon-folder',
                            'height' => '550px',
                            'width'  => '976px', // 90%
                        ],
                        'editor'  => [
                            'theme'           => 'black', // 主题 primary|black|grey|blue
                            'items'           => null,    // 菜单内容
                            'editorUploadUrl' => '',
                            'editorManageUrl' => '',
                            'editorMediaUrl'  => '',
                            'editorFlashUrl'  => '',
                            'editorFileUrl'   => '',
                        ],
                    ]
                );


                $form->rule(
                    [
                        $form::uploads('avatar', '头像')->props(
                            [ // props配置将会覆盖掉global全局配置
                                'manageUrl'  => '', // 文件管理地址
                                'action'     => '', // 文件上传地址
                                'uploadType' => 'file', // 文件类型 支持image|file
                            ]
                        ),

                        $form::frame('frame1', '选择用户')->props([
                                                                 'type'=>'file',                   // 文件类型
                                                                 'src'=>'?',               // 文件地址
                                                                 'height'=>'500px',
                                                                 'width'=>'1000px',
                                                                 'icon' => 'el-icon-folder',                // 默认图标
                                                                 'maxLength' => 3,                          // 选取长度
                                                                 'title' => "选择",                          // 说明
                                                             ]),

                        Form::text("version", "版本号", '1.0.1')->validate(['message' => "版本号格式错误", 'pattern' => "\d+\.\d+\.\d+"]),
                        $form::text('name', '姓名', '')->validate(['required' => 'true', 'message' => '用户名不能为空', 'trigger' => 'blur']),
                        $form::radio('sex', '性别', '1')->addOptions(['1' => '男', '2' => '女', '3' => '其他']),
                        $form::number('age', '年龄', '18'),
                        $form::json('json', 'json', json_encode(['a' => 'aa', 'b' => 'bb'])),
                        $form::select('hobby', '爱好')->addOptions(['1' => '唱歌', '2' => '跳舞', '3' => 'rap', '4' => '篮球']),
                        $form::switcher('status', '状态', 1)->addOptions(0, 1),
                        $form::editor('editor', 'editor', "<h2>Hello</h2>"),
                        $form::area('area', 'area'),
                        $form::datetime('datetime', 'datetime', ''),
                        $form::color('color', 'color', ''),
                        $form::slider('slider', 'slider', ''),
                        $form::range('range', 'range',123 ),
                        $form::rate('range', 'range'),


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
                                        $form::tab('pic1', 'tab', 'upyun1', [
                                             'children' => [
                                                 'ali1'   => [
                                                     'name'     => 'ali1',
                                                     'title'    => 'ali1',
                                                     'children' => [
                                                         $form::text('appid1', 'appId1', 'ali'),
                                                     ],
                                                 ],
                                                 'upyun1' => [
                                                     'name'     => 'upyun1',
                                                     'title'    => 'upyun1',
                                                     'children' => [
                                                         $form::text('appid1', 'appId1', 'upyun')->props(['disabled' => true]),
                                                     ],
                                                 ],
                                                 'qiniu1' => [
                                                     'name'     => 'qiniu1',
                                                     'title'    => 'qiniu1',
                                                     'children' => [
                                                         $form::text('appid1', 'appId1', 'qiniu'),
                                                     ],
                                                 ],
                                             ]]
                                        ),
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
    }

}
