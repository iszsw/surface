<?php

namespace surface\test\form;

use surface\Component;
use surface\form\components\Checkbox;
use surface\form\components\Color;
use surface\form\components\Date;
use surface\form\components\Editor;
use surface\form\components\Group;
use surface\form\components\Input;
use surface\form\components\Number;
use surface\form\components\Objects;
use surface\form\components\Radio;
use surface\form\components\Rate;
use surface\form\components\Select;
use surface\form\components\Slider;
use surface\form\components\Switcher;
use surface\form\components\Take;
use surface\form\components\Time;
use surface\form\components\Tree;
use surface\form\components\Upload;
use surface\helper\FormInterface;

class Form implements FormInterface
{

    public function options(): array
    {
        return  [
            'resetBtn' => true,
            'async'    => [
                'url' => '',
            ],
            'form'     => [
                'labelWidth' => '100px',
            ],
        ];
    }

    public function columns(): array
    {
        return [
                (new Input('username', '用户名'))
                    ->marker('要不得')
                    ->validate([['required' => true, 'message' => '用户名必须']])
                    ->children([(new Component(['type' => 'span']))->domProps(['innerText' => '元'])->slot('append')]),
                (new Input('info', '说明')),
                (new Number('price', '价格'))->props('step', 5),
                (new Select('hobby', '爱好'))->options(
                    [
                        ['value' => 1, 'label' => '干饭'],
                        ['value' => 2, 'label' => '打麻将'],
                        ['value' => 3, 'label' => '睡觉'],
                        ['value' => 4, 'label' => '爬山'],
                    ]
                )->props('multiple', ! 0),
                (new Checkbox('label', '标签', []))->options(
                    [
                        ['value' => 1, 'label' => '干饭'],
                        ['value' => 2, 'label' => '打麻将'],
                        ['value' => 3, 'label' => '睡觉'],
                        ['value' => 4, 'label' => '爬山'],
                    ]
                ),
                new Switcher('postage', '包邮', 0),
                (new Date('section_day', '日期'))->props(
                    [
                        'type'        => "datetimerange",
                        'format'      => "yyyy-MM-dd HH:mm:ss",
                        'placeholder' => "请选择活动日期",
                    ]
                ),
                (new Time('section_time', '时间'))->props(
                    [
                        'isRange' => ! 0,
                    ]
                ),
                new Color('color', '颜色', '#333333'),
                new Rate('rate', '评分', 2),
                (new Slider('slider', '范围', [15, 27]))->props(['min' => 10, 'max' => 30, 'range' => ! 0]),
                (new Tree('tree', '树'))->props(
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
                new Editor('content', '说明', '<h1>666</h1>'),
                (new Upload('avatar', '头像'))->props(
                    [
                        'maxLength' => 5,
                    ]
                ),
                (new Group(
                    'group', '配置', [
                               ['username' => '张三', 'age' => 18, 'hobby' => '干饭'],
                           ]
                ))->props(
                    'rules', [
                               new Input('username', '用户名'),
                               new Input('age', '年龄'),
                               new Input('hobby', '爱好'),
                           ]
                ),
                (new Objects('object', 'json配置', ['username' => '666', 'age' => 18]))->props(
                    'rule', [
                              new Input('username', '用户名'),
                              new Number('age', '爱好'),
                          ]
                ),
                (new Radio('examine', '审核', 'ok'))->options(
                    [
                        ['value' => 'ok', 'label' => '通过'],
                        ['value' => 'no', 'label' => '拒绝'],
                    ]
                )->control(
                    [
                        [
                            'value' => 'no',
                            'rule'  => [
                                new Editor('reason', '拒绝理由'),
                            ],
                        ],
                    ]
                )->marker("hahaha"),

                (new Checkbox('tab', 'tab选择'))->options(
                    [
                        ['value' => 1, 'label' => '干饭'],
                        ['value' => 2, 'label' => '打麻将'],
                    ]
                )->control(
                    [
                        [
                            'handle' => 'val.indexOf(1) >= 0',
                            'rule'   => [
                                new Input('tabInput1', '选择1'),
                            ],
                        ],
                        [
                            'handle' => 'val.indexOf(2) >= 0',
                            'rule'   => [
                                new Input('tabInput2', '选择2'),
                            ],
                        ],
                    ]
                ),
                (new Take('user_id', '联合选择', [1, 2, 3]))->options(
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

            ];
    }

    public function save()
    {
        return "操作成功";
    }

}
