<?php

namespace surface\test\form;

use surface\Component;
use surface\form\components\Checkbox;
use surface\form\components\Color;
use surface\form\components\Date;
use surface\form\components\Editor;
use surface\form\components\Group;
use surface\form\components\Hidden;
use surface\form\components\Input;
use surface\form\components\Number;
use surface\form\components\Objects;
use surface\form\components\Radio;
use surface\form\components\Rate;
use surface\form\components\Select;
use surface\form\components\Slider;
use surface\form\components\Switcher;
use surface\form\components\Time;
use surface\form\components\Tree;
use surface\helper\AbstractForm;

class Form extends AbstractForm
{

    public static function formatOptions(array $options, $labelName = 'label', $valueName = 'value'): array
    {
        $data = [];
        foreach ($options as $k => $v) {
            array_push($data, [$labelName => $v, $valueName => $k]);
        }
        return $data;
    }

<<<<<<< HEAD
    /**
     * 配置
     *
     * @return array
     */
=======
>>>>>>> 0df92f05daa46f780b739eaf5d880f4f92b55a98
    public function options(): array
    {
        return [
            'async'    => [
                'url' => '',
            ],
            'form'     => [
                'labelWidth' => '100px',
            ],
        ];
    }

    /**
     * 列
     *
     * @return array
     */
    public function columns(): array
    {
        return [
            (new Input('username', '用户名'))
                ->input('username', '用户名', '用户名必须填，必须！必须！必须！')
                ->marker('要不得')
                ->validate(
                    [
                        ['required' => true, 'message' => '用户名必须'],
                    ]
                )
                ->children([(new Component)->el('span')->item(false)->domProps(['innerText' => '元'])->slot('append')]),
            (new Hidden('Hidden', '说明')),
            (new Number('price', '价格'))->props('step', 5),
            (new Select('hobby', '爱好'))->select('hobby', '爱好')->options(self::formatOptions([1 => '干饭', '打麻将', '睡觉', '爬山']))->props('multiple', ! 0),
            (new Checkbox('label', '标签', []))->checkbox('label', '标签', [])
                ->options(self::formatOptions([1 => '干饭', '打麻将', '睡觉', '爬山']))
                ->props('max', 2)->props('group', ! 0), //group = true button样式  false 普通样式
            (new Radio('examine', '审核', 2))->options(self::formatOptions([1 => '干饭', '打麻将', '睡觉', '爬山']))
                ->props('group', ! 1), //group = true button样式  false 普通样式
            new Switcher('postage', '包邮', 0),
            (new Date('section_day', '日期'))->props(
                [
                    'type'         => "datetimerange",
                    'value-format' => "yyyy-MM-dd HH:mm:ss",
                ]
            ),
            (new Time('section_time', '时间'))->props(
                [
                    'isRange'      => ! 0,
                    'value-format' => "HH:mm:ss",
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

            (new Number('pricea', '我是惊喜', 2))->marker('惊不惊喜')->props('step', 5)
                ->visible([['prop' => 'priceb', 'value' => 10],]), // 字段显示条件配置

            (new Number('priceb', '价格', 8))->marker('把我加到10有惊喜'),
        ];
    }

    /**
     * 保存回调事件
     *
     * true | false | 错误说明
     */
    public function save():bool
    {
        $this->error = '操作失败了';
        return false;
    }

}
