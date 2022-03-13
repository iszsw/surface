<?php

namespace surface\test;

require '../vendor/autoload.php';

use surface\Component;
use surface\Factory;
use surface\table\components\Button;

function formatOptions(array $options, $labelName = 'label', $valueName = 'value'): array
{
    $data = [];
    foreach ($options as $k => $v) {
        $data[] = [$labelName => $v, $valueName => $k];
    }
    return $data;
}

class Surface
{

    public function __construct()
    {
        // 注册配置
        Factory::configure(require 'config.php');
    }

    private function search()
    {

        $form = Factory::form();

        $form->search(true); // 启用search 作为table子页面交互，将获取数据作为table拉取数据的参数

        /**
         * 表配置
         */
        $form->options(
            [
                'submitBtn' => [
                    'props' => [
                        'prop' => [
                            'type' => 'primary',
                            'icon' => 'el-icon-search',
                        ],
                        //  'confirmMsg' => '确定搜索吗',
                    ],
                ],
                // resetBtn 配置同 submitBtn
                'props'     => [
                    'labelWidth' => '100px',
                ],
            ]
        );

        /**
         * 列配置
         */
        $form->columns(
            [
                $form->input('username', '用户名')->props('placeholder', "啦啦啦啦啦"),
                $form->switcher('postage', '包邮', 0),
                $form->date('section_day', '日期')->props(
                    [
                        'type'        => "datetimerange",
                        'format'      => "yyyy-MM-dd HH:mm:ss",
                        'placeholder' => "请选择活动日期",
                    ]
                ),
            ]
        );
        return $form;
    }

    public function table()
    {
        $table = Factory::table();

        /**
         * 表配置
         */
        $table->options(
            'props', [
                       'emptyText' => "求求你别看了，没有啦",
                   ]
        );

        // 注册搜索
        $table->search($this->search());

        /**
         * 顶部
         */
        $table->header(
            (new Component(['el' => 'div']))->children(
                [
                    (new Component())->el('div')->children(
                        [
                            (new Component())->el('el-breadcrumb')->children(
                                [
                                    (new Component())->el('el-breadcrumb-item')->children(['会员中心']),
                                    (new Component())->el('el-breadcrumb-item')->children(['会员管理']),
                                    (new Component())->el('el-breadcrumb-item')->children(['会员列表']),
                                ]
                            ),
                            (new Component())->el('h2')->children(['会员列表']),
                            (new Component())->el('el-alert')->style('margin-bottom', '20px')->props(['title' => '我是一个自定义的el-alert标签，来看看怎么用吧', 'type' => 'error', 'effect'=>'dark']),
                        ]
                    ),
                    (new Button('el-icon-check', '提交'))->createSubmit(
                        ['method' => 'post', 'data' => ['username' => 'hello'], 'url' => 'data.php'],
                        '确认提交选择的数据',
                        'id'
                    ),
                    (new Button('el-icon-refresh', '刷新'))->createRefresh(),
                    $table->button('el-icon-plus', '编辑')->createPage('?form=1')->props('doneRefresh', true),
                    (new Button('el-icon-search', '搜索'))->createSearch(),
                ]
            )
        );

        /**
         * 列配置
         */
        $table->columns( // 列配置
            [
                $table->selection('id'),
                $table->expand('address', '地址')->scopedSlots([$table->component(['el' => 'span', 'inject' => ['children']])]),
                $table->column('avatar', '头像')->scopedSlots(
                    [
                        $table->component(
                            [
                                'el'     => 'img',
                                'style'  => ['width' => '50px'],
                                'inject' => ['attrs' => ['src']],
                            ]
                        ),
                    ]
                ),
                $table->column('avatar', '头像大图')->scopedSlots(
                    [
                        $table->component(
                            [
                                'el'     => 'el-image',
                                'style'  => ['width' => '50px'],
                                'inject' => ['attrs' => ['src', 'array.preview-src-list']],
                            ]
                        ),
                    ]
                ),
                $table->column('vip', 'VIP')->scopedSlots([$table->component(['inject' => ['domProps' => 'innerHTML']])]),
                $table->column('username', '用户名')->props(['show-overflow-tooltip' => true, 'sortable' => true, 'width' => '150px']),
                $table->column('phone', '手机')->scopedSlots(
                    [
                        $table->writable()->props(['async' => ['method' => 'post', 'data' => ['id'], 'url' => 'data.php']]),
                    ]
                )->props('width', '150px'),
                $table->column('status', '状态')->scopedSlots(
                    [
                        $table->switcher()->props(['async' => ['method' => 'post', 'data' => ['id'], 'url' => 'data.php',]]),
                    ]
                ),
                $table->column('sex', '性别')->scopedSlots(
                    [
                        $table->select()->props(
                            [
                                'async'   => ['method' => 'post', 'data' => ['id', 'username' => 'hello'], 'url' => 'data.php'],
                                'options' => [1 => '男', '女', '未知',],
                            ]
                        ),
                    ]
                ),
                $table->column('tag', '标签')->scopedSlots([$table->component(['el' => 'el-tag', 'inject' => ['children', 'title']])]),
                $table->column('options', '操作')->props('fixed', 'right')
                    ->scopedSlots(
                        [
                            $table->button('el-icon-edit', '编辑')
                                ->visible('option_edit') // option_edit字段为真显示按钮
                                ->createPage('?form=1', ['id', 'username' => 'hello'])
                                ->props('doneRefresh', true), // 完成之后刷新页面

                            $table->button('el-icon-delete', '删除')
                                ->createConfirm('确认删除数据？', ['method' => 'post', 'data' => ['id', 'username' => 'hello'], 'url' => 'data.php',]),
                        ]
                    ),
            ]
        );


        /**
         * 分页配置
         */
        $table->pagination(
            (new Component())->props(
                [
                    'async' => [
                        'url' => 'data.php', // 请求地址
                        //                                'data' => [], // 请求扩展参数
                        //                                ... // axios 参数
                    ],
                ]
            )
        );

        return $table;
    }

    public function form()
    {
        $form = Factory::form();

        /**
         * 表配置
         */
        $form->options(
            [
                //                'resetBtn' => true,
                'async' => [
                    'url' => '/upload.php',
                ],
            ]
        );

        $mixin = <<<JS
<script>
    // 全局混入事件
    Vue.mixin({
            methods: {
                hello() {
                    alert("全局混入事件")
                    // \$surfaceForm 是surfaceForm API对象
                    \$surfaceForm.change(this.prop, 'ok')
                }
            }
        })
        
    // 自定义组件 注册world组件
        surfaceForm.component({
            name: 'world',
            events: {
                // 参数初始化时（组件未注册）调用
                onInit(c) {
                    console.log('surfaceForm自定义组件配置初始化')
                }
            },
            component: {
                name: 'world',
                props: {
                    label: String,
                    prop: String,
                    value: [String],
                    model: Object
                },
                render(h) {
                    return h("el-button", {
                        on: {
                            click() {
                                alert('surfaceForm组件注册')
                            }
                        }
                    }, this.value)
                }
            }
        })
</script>
JS;

        // 注册js资源
        $form->addScript($mixin);

        /**
         * 列配置
         */
        $form->columns(
            [
                // 点击事件绑定hello方法
                $form->column('button','绑定事件','')->el('el-button')->on('click', 'hello')->children(["全局混入事件"]),
                $form->column('world','自定义组件','surface-form自定义world组件')->el('world'),

                $form->input('username', '用户名', '用户名必须填，必须！必须！必须！')
                    ->marker('要不得')
                    ->validate(
                        [
                            ['required' => true, 'message' => '用户名必须'],
                        ]
                    )
                    ->children([$form->component(['el' => 'span'])->item(false)->domProps(['innerText' => '元'])->slot('append')]),
                $form->hidden('hidden', '看不见我'),
                $form->number('price', '价格')->props('step', 5),
                $form->select('hobby', '爱好', [2, 3])->options(formatOptions([1 => '干饭', '打麻将', '睡觉', '爬山']))->props('multiple', ! 0),
                $form->checkbox('label', '标签', [2])
                    ->marker("最多选2个")
                    ->options(formatOptions([1 => '干饭', '打麻将', '睡觉', '爬山']))->props('max', 2)
                    ->props('group', ! 0), //group = true button样式  false 普通样式
                $form->radio('examine', '干啥呢', 2)->options(formatOptions([1 => '干饭', '打麻将', '睡觉', '爬山']))
                    ->props('group', ! 1), //group = true button样式  false 普通样式,
                $form->switcher('postage', '包邮', 0),
                $form->date('section_day', '日期', ["2021-03-04 00:00:00", "2021-04-13 00:00:00"])->props(
                    [
                        'type'         => "datetimerange",
                        'value-format' => "yyyy-MM-dd HH:mm:ss",
                    ]
                ),
                $form->time('section_time', '时间')->props(
                    [
                        'isRange'      => ! 0,
                        'value-format' => "HH:mm:ss",
                    ]
                ),
                $form->color('color', '颜色', '#333333'),
                $form->rate('rate', '评分', 2),
                $form->slider('slider', '范围', [15, 27])->props(['min' => 10, 'max' => 30, 'range' => ! 0]),
                $form->cascader('cascader', 'cascader')->props( // 异步选择
                    [
                        'debounce'  => 100,
                        'clearable' => ! 0,
                        'async'     => [
                            'url' => '/cascaderData.php',
                        ],
                    ]
                ),
                $form->cascader('cascader1', 'cascader1', ['CQ', 'JB'])->options(// 同步选择
                    [
                        [
                            'value'    => 'BJ',
                            'label'    => '北京',
                            'children' => [
                                [
                                    'value' => 'TAM',
                                    'label' => '天安门',
                                ],
                                [
                                    'value' => 'TT',
                                    'label' => '天坛',
                                ],
                            ],
                        ],
                        [
                            'value'    => 'CQ',
                            'label'    => '重庆',
                            'children' => [
                                [
                                    'value' => 'JB',
                                    'label' => '江北区',
                                ],
                                [
                                    'value' => 'NN',
                                    'label' => '南岸区',
                                ],
                            ],
                        ],
                    ]
                ),
                $form->editor('content', '说明', '<h1>666</h1>')->props(
                    [
                        'uploadUrl' => 'upload.php', // 上传地址
                        'manageUrl' => 'images.php', // 文件管理地址
                        'typeName'  => 'type',        // 不同类型文件上传携带的参数 类型KEY
                        'config'    => [                // wangEditor配置参数
                                                        'showLinkImgAlt' => false,
                        ],
                    ]
                ),
                $form->upload('avatar', '头像', ["http://q1.qlogo.cn/g?b=qq&nk=191587814&s=640"])->props(
                    [
                        'manageUrl' => 'images.php', // 文件管理地址
                        'action'    => 'upload.php', // 上传地址
                        'limit'     => 5,
                    ]
                ),
                $form->take('user_id', '联合选择', ['a', 'c'])->options(
                    formatOptions([
                                      'a' => '张三',
                                      'b' => '<img src="http://q1.qlogo.cn/g?b=qq&nk=191587'.rand(100, 999).'&s=640" class="take-img"> 李四',
                                      'c' => '<img src="http://q1.qlogo.cn/g?b=qq&nk=191587'.rand(100, 999).'&s=640" class="take-img"> 李四',
                                  ])
                )->props(
                    [
                        //                        'url'    => 'images.php?take=1',
                        'url'    => '/',
                        'unique' => true, // 唯一
                        'limit'  => 9,
                    ]
                ),
                $form->arrays('arrays', 'json', [['json_input' => "啦啦啦", 'json_checkbox' => [1, 3]]])->options(
                    [
                        $form->input('json_input', '用户名'),
                        $form->number('json_number', '年龄'),
                        $form->checkbox('json_checkbox', '爱好')->options(formatOptions([1 => '干饭', '打麻将', '睡觉', '爬山']))->props('max', 2),
                    ]
                )->props(
                    [
                        'span'   => 24, // 最大24 不设置每行宽度 将平均分配
                        'title'  => ! 1, // 显示标题 一行数据时显示  多行数据不要启用
                        'append' => ! 0, // 支持追加数据
                    ]
                ),
                $form->number('pricea', '我是惊喜', 2)->marker('惊不惊喜')
                    ->props('step', 5)->visible([['prop' => 'priceb', 'value' => 10],]), // 字段显示条件配置
                $form->number('priceb', '价格', 8)->marker('把我加到10有惊喜')
                    ->visible([['prop' => 'tree', 'exec' => 'val.indexOf(1) >= 0']]), // 字段显示条件配置
                $form->tree('tree', '树')->marker('选中我试一试')->props(
                    [
                        'check-strictly'     => ! 0,
                        'auto-expand-parent' => ! 1,
                        'showCheckbox'       => ! 0,
                        'node-key'           => 'id',
                        'data'               => [
                            [
                                'id'       => 1,
                                'label'    => '大锅',
                                'expand'   => ! 0,
                                'selected' => ! 1,
                                'children' => [
                                    [
                                        'id'       => 101,
                                        'label'    => '二锅',
                                        'expand'   => ! 0,
                                        'children' => [
                                            [
                                                'id'    => 10101,
                                                'label' => '小明',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ]
                ),

                //自定义格式
                $form->column('', 'tabs')->el('el-tabs')->children(
                    [ // 作为子组件 一定取消使用form-item作为外层 设置item(false)
                      $form->component()->el('el-tab-pane')->props('label', 'tab1')->item(false)->children(
                          [
                              $form->input('tab1-name', '姓名1'),
                              $form->input('tab1-age', '年龄1'),
                          ]
                      ),
                      $form->component()->el('el-tab-pane')->props('label', 'tab2')->item(false)->children(
                          [
                              $form->input('tab2-name', '姓名2'),
                              $form->input('tab2-age', '年龄2'),
                          ]
                      ),
                    ]
                ),

            ]
        );

        return $form;
    }
}


$index = new Surface();

if ($_GET['form'] ?? false)
{
    $surface = $index->form();
} else
{
    $surface = $index->table();
}

//print_r($surface->getColumns());

$view = $surface->view();

echo $view;


