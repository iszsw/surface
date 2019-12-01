<?php
/*
 * Author: zsw zswemail@qq.com
 */

namespace surface\test;

use surface\form\Form;
use surface\helper\tp\Curd;
use surface\helper\tp\FormInterface;
use surface\helper\tp\TableInterface;
use surface\table\Table;
use surface\table\Type;

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
     * Author: zsw zswemail@qq.com
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

            public function defaults(Table $table): array
            {
                return [
                    'title'         => '管理',
                    'description'   => '会员管理',
                    'topBtn'        => [
                        $table::button(
                            'page', 'create', [
                            'title' => "添加",
                            'refresh' => true,
                            'url' => 'create',
                        ], 'fa fa-plus')
                    ],
                    'operations'    => [
                        $table::button('page', 'edit', [
                            'title' => '编辑',
                            'url' => 'edit',
                            'method' => 'get',
                            'refresh' => true,
                            'params' => ['pk'], // 当前列需要提交的字段名
                        ], 'fa fa-edit'),
                    ],
                ];
            }

            public function column(Table $table): array
            {
                return [
                    'id' => [
                        'title' => "ID",
                        'sort' => true,
                    ],
                    'username' => "姓名",
                    'phone' => [
                        'title' => '电话',
                        'type' => Type::TEXT_EDIT,
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

                $data = [ // 页面必须返回数据总数count和数据list 如果不需要分页可以忽略count
                    'count' => 1000,
                    'list' => $data,
                ];

                return json_encode([
                                       'code' => 0,
                                       'msg'  => '请求成功',
                                       'data' => $data,
                                   ], JSON_UNESCAPED_UNICODE);
            }
        };
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

            public function column(Form $form): array
            {
                return [
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
                    Form::text('name', '姓名', '')->validate(['required' => 'true', 'message' => '用户名不能为空', 'trigger' => 'blur']),
                    Form::radio('sex', '性别', '1')->addOptions(['1' => '男', '2' => '女', '3' => '其他']),
                    $form::number('age', '年龄', '18'),
                    $form::select('hobby', '爱好')->addOptions(['1' => '唱歌', '2' => '跳舞', '3' => 'rap', '4' => '篮球']),
                    $form::switcher('status', '状态', 1)->addOptions(0, 1),
                ];
            }

            public function save()
            {
                // 逻辑操作

                return json_encode([
                                       'code' => 0,
                                       'msg'  => '请求成功',
                                       'data' => '',
                                   ], JSON_UNESCAPED_UNICODE);
            }
        };
    }


}