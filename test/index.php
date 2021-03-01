<?php

namespace surface\test;

require '../vendor/autoload.php';

use surface\Component;
use surface\Factory;
use surface\table\components\Button;
use surface\table\components\Pagination;

class Surface
{

    public function __construct()
    {
        // 注册配置
        Factory::configure(require 'config.php');
    }

    public function search()
    {

        $form = Factory::form();

        /**
         * 表配置
         */
        $form->options(
            [
                'search'    => true,
                'submitBtn' => [
                    'innerText' => '搜索',
                ],
                'async'     => [
                    'url' => '/',
                ],
                'form'      => [
                    'labelWidth' => '100px',
                ],
            ]
        );

        /**
         * 列配置
         */
        $form->columns(
            [
                $form->input('username', '用户名'),
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

        /**
         * 顶部
         */
        $table->header(
            (new Component(['el' => 'div']))->children(
                [
                    (new Button('el-icon-check', '提交'))->createSubmit(
                        ['method' => 'post', 'data' => ['username' => 'hello'], 'url' => 'data.php'],
                        '确认提交选择的数据',
                        'id'
                    ),
                    (new Button('el-icon-refresh', '刷新'))->createRefresh(),
                    $table->button('el-icon-plus', '编辑')->createPage('?form=1'),
                    (new Button('el-icon-search', '搜索'))->createPage('?search=1')->props('doneRefresh', false),
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
                        $table->writable()->props(['method' => 'post', 'async' => ['data' => ['id'], 'url' => 'data.php']]),
                    ]
                )->props('width', '150px'),
                $table->column('status', '状态')->scopedSlots(
                    [
                        $table->switcher()->props(['method' => 'post', 'async' => ['data' => ['id'], 'url' => 'data.php',]]),
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
                            $table->button('el-icon-edit', '编辑')->createPage('?form=1', ['id', 'username' => 'hello']),
                            $table->button('el-icon-delete', '删除')
                                ->createConfirm('你要删除我吗？', ['method' => 'post', 'data' => ['id', 'username' => 'hello'], 'url' => 'data.php',]),
                        ]
                    ),
            ]
        );


        /**
         * 分页配置
         */
        $table->pagination(
            (new Pagination())->props(
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
                'resetBtn' => true,
                'async'    => [
                    'url' => '/data.php',
                ],
                'form'     => [
                    'labelWidth' => '100px',
                ],
            ]
        );

        /**
         * 列配置
         */
        $form->columns(
            [
                $form->input('username', '用户名')
                    ->marker('要不得')
                    ->validate([['required' => true, 'message' => '用户名必须']])
                    ->children([$form->component(['type' => 'span'])->domProps(['innerText' => '元'])->slot('append')]),
                $form->input('info', '说明'),
                $form->number('price', '价格')->props('step', 5),
                $form->select('hobby', '爱好')->options(
                    [
                        ['value' => 1, 'label' => '干饭'],
                        ['value' => 2, 'label' => '打麻将'],
                        ['value' => 3, 'label' => '睡觉'],
                        ['value' => 4, 'label' => '爬山'],
                    ]
                )->props('multiple', ! 0),
                $form->checkbox('label', '标签', [])->options(
                    [
                        ['value' => 1, 'label' => '干饭'],
                        ['value' => 2, 'label' => '打麻将'],
                        ['value' => 3, 'label' => '睡觉'],
                        ['value' => 4, 'label' => '爬山'],
                    ]
                ),
                $form->switcher('postage', '包邮', 0),
                $form->date('section_day', '日期')->props(
                    [
                        'type'        => "datetimerange",
                        'format'      => "yyyy-MM-dd HH:mm:ss",
                        'placeholder' => "请选择活动日期",
                    ]
                ),
                $form->time('section_time', '时间')->props(
                    [
                        'isRange' => ! 0,
                    ]
                ),
                $form->color('color', '颜色', '#333333'),
                $form->rate('rate', '评分', 2),
                $form->slider('slider', '范围', [15, 27])->props(['min' => 10, 'max' => 30, 'range' => ! 0]),
                $form->tree('tree', '树')->props(
                    [
                        'type'              => 'checked',
                        'defaultExpandAll'  => ! 0,
                        'checkOnClickNode'  => ! 0,
                        'expandOnClickNode' => ! 1,
                        'multiple'          => ! 0,
                        'showCheckbox'      => ! 0,
                        'data'              => [
                            [
                                'id'       => 1,
                                'title'    => 'a',
                                'expand'   => ! 0,
                                'selected' => ! 1,
                                'children' => [
                                    [
                                        'id'       => 101,
                                        'title'    => 'a1',
                                        'expand'   => ! 0,
                                        'children' => [
                                            [
                                                'id'    => 10101,
                                                'title' => 'a11',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        'props'             => ['label' => 'title'],
                    ]
                ),
                $form->editor('content', '说明', '<h1>666</h1>'),
                $form->upload('avatar', '头像')->props(
                    [
                        'maxLength' => 5,
                    ]
                ),
                $form->group(
                    'group', '配置', [
                               ['username' => '张三', 'age' => 18, 'hobby' => '干饭'],
                           ]
                )->props(
                    'rules', [
                               $form->input('username', '用户名'),
                               $form->input('age', '年龄'),
                               $form->input('hobby', '爱好'),
                           ]
                ),
                $form->objects('object', 'json配置', ['username' => '666', 'age' => 18])->props(
                    'rule', [
                              $form->input('username', '用户名'),
                              $form->number('age', '爱好'),
                          ]
                ),
                $form->radio('examine', '审核', 'ok')->options(
                    [
                        ['value' => 'ok', 'label' => '通过'],
                        ['value' => 'no', 'label' => '拒绝'],
                    ]
                )->control(
                    [
                        [
                            'value' => 'no',
                            'rule'  => [
                                $form->editor('reason', '拒绝理由'),
                            ],
                        ],
                    ]
                )->marker("hahaha"),

                $form->checkbox('tab', 'tab选择')->options(
                    [
                        ['value' => 1, 'label' => '干饭'],
                        ['value' => 2, 'label' => '打麻将'],
                    ]
                )->control(
                    [
                        [
                            'handle' => 'val.indexOf(1) >= 0',
                            'rule'   => [
                                $form->input('tabInput1', '选择1'),
                            ],
                        ],
                        [
                            'handle' => 'val.indexOf(2) >= 0',
                            'rule'   => [
                                $form->input('tabInput2', '选择2'),
                            ],
                        ],
                    ]
                ),
                $form->take('user_id', '联合选择', [1, 2, 3])->options(
                    [
                        ['value' => 1, 'label' => '张三'],
                        ['value' => 2, 'label' => '<img src="http://q1.qlogo.cn/g?b=qq&nk=191587'.rand(100, 999).'&s=640" class="take-img"> 李四'],
                        ['value' => 3, 'label' => '<img src="http://q1.qlogo.cn/g?b=qq&nk=191587'.rand(100, 999).'&s=640" class="take-img"> 李四'],
                    ]
                )->props(
                    [
                        'src' => '/',
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
    if ($_GET['search'] ?? false)
    {
        $surface = $index->search();
    } else
    {
        $surface = $index->table();
    }
}

$view = $surface->view();

echo $view;


