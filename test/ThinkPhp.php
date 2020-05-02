<?php
namespace app\controller;

use surface\form\Form;
use surface\helper\tp\Curd;

use surface\helper\tp\FormInterface;
use surface\helper\tp\TableInterface;
use surface\table\Table;

class ThinkPhp
{

    use Curd;

    public function index()
    {
        return $this->createTable($this->getTable());
    }

    /**
     * 获取table类
     *
     * 单页面太臃肿可以将TableInterface FormInterface实现独立成单独文件
     *
     * @return TableInterface
     */
    private function getTable()
    {
        return new class implements TableInterface
        {

            public function rules(): array
            {
                return [
                    ['EQ', 'text', 'id', 'ID'],
                    ['LIKE', 'text', 'username', '姓名'],
                ];
            }

            public function defaults(): array
            {
                return [
                    'title'         => '管理',
                    'description'   => '会员管理',
                    'topBtn'        => [
                        Table::button(
                            'page', 'create', [
                            'title' => "添加",
                            'refresh' => true,
                            'url' => 'index/create',
                        ], 'fa fa-plus')
                    ],
                    'operations'    => [
                        Table::button('page', '', [
                            'title' => '编辑',
                            'url' => 'index/create',
                            'method' => 'get',
                            'refresh' => true,
                            'params' => ['pk'], // 当前列需要提交的字段名
                        ], 'fa fa-edit'),
                    ],
                ];
            }

            public function column(): array
            {
                return [
                    'id' => [
                        'title' => "ID",
                        'sort' => true,
                    ],
                    'name' => "姓名",
                    'tel' => [
                        'title' => '电话',
                        'type' => 'textEdit',
                        'edit_url' => 'edit_status',
                    ],
                    'status' => [
                        'title' => '状态',
                        'type' => 'switchEdit',
                        'edit_url' => 'edit_status',
                        'options' => [0 => '锁定', 1 => '正常']
                    ],
                ];
            }

            public function search($where = [], $order = '', $page = 1, $row_num = 15): array
            {
                // 逻辑操作
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

                return [ // 页面必须返回数据总数count和数据list 如果不需要分页可以忽略count
                         'count' => 1000,
                         'list' => $data,
                ];
            }
        };
    }


    public function create()
    {
        return $this->edit();
    }


    public function edit()
    {
        return $this->createForm($this->getForm());
    }

    protected function getForm()
    {
        return new class implements FormInterface
        {

            public function defaults(): array
            {
                return [];
            }

            public function column(): array
            {
                return [
                    Form::text("version", "版本号", '1.0.1')->validate(['message' => "版本号格式错误", 'pattern' => "\d+\.\d+\.\d+"]),
                    Form::text('name', '姓名', '')->validate(['required' => 'true', 'message' => '用户名不能为空', 'trigger' => 'blur']),
                    Form::radio('sex', '性别', '1')->addOptions(['1' => '男', '2' => '女', '3' => '其他']),
                    Form::number('age', '年龄', '18'),
                    Form::select('hobby', '爱好')->addOptions(['1' => '唱歌', '2' => '跳舞', '3' => 'rap', '4' => '篮球']),
                    Form::switcher('status', '状态', 1)->addOptions(0, 1),
                    Form::json('json', 'json', json_encode(['a' => 'aa', 'b' => 'bb'])),
                    Form::select('hobby', '爱好')->addOptions(['1' => '唱歌', '2' => '跳舞', '3' => 'rap', '4' => '篮球']),
                    Form::switcher('status', '状态', 1)->addOptions(0, 1),
                    Form::editor('editor', 'editor', "<h2>Hello</h2>"),
                    Form::area('area', 'area'),
                    Form::datetime('datetime', 'datetime', ''),
                    Form::color('color', 'color', ''),
                    Form::slider('slider', 'slider', ''),
                    Form::range('range', 'range',123 ),
                    Form::rate('range', 'range'),
                    Form::tab(
                        'pic', 'tab', 'upyun', [
                        'children' => [
                            'ali'   => [
                                'name'     => 'ali',
                                'title'    => 'ali',
                                'children' => [
                                    Form::text('appid', 'appId', 'ali'),
                                ],
                            ],
                            'upyun' => [
                                'name'     => 'upyun',
                                'title'    => 'upyun',
                                'children' => [
                                    Form::text('appid', 'appId', 'upyun')->props(['disabled' => true]),
                                ],
                            ],
                            'qiniu' => [
                                'name'     => 'qiniu',
                                'title'    => 'qiniu',
                                'children' => [
                                    Form::tab('pic1', 'tab', 'upyun1', [
                                                        'children' => [
                                                            'ali1'   => [
                                                                'name'     => 'ali1',
                                                                'title'    => 'ali1',
                                                                'children' => [
                                                                    Form::text('appid1', 'appId1', 'ali'),
                                                                ],
                                                            ],
                                                            'upyun1' => [
                                                                'name'     => 'upyun1',
                                                                'title'    => 'upyun1',
                                                                'children' => [
                                                                    Form::text('appid1', 'appId1', 'upyun')->props(['disabled' => true]),
                                                                ],
                                                            ],
                                                            'qiniu1' => [
                                                                'name'     => 'qiniu1',
                                                                'title'    => 'qiniu1',
                                                                'children' => [
                                                                    Form::text('appid1', 'appId1', 'qiniu'),
                                                                ],
                                                            ],
                                                        ]]
                                    ),
                                ],
                            ],
                        ],
                    ])
                ];
            }

            public function save()
            {
                // 逻辑操作
                return json_encode([
                                       'code' => 0,
                                       'msg'  => '保存成功',
                                       'data' => '',
                                   ], JSON_UNESCAPED_UNICODE);
            }
        };
    }


}
