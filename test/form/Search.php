<?php

namespace surface\test\form;

use surface\form\components\Date;
use surface\form\components\Input;
use surface\form\components\Switcher;
use surface\helper\FormAbstract;

class Search extends FormAbstract
{

    public function init($form)
    {
        $form->search(true);
    }

    public function options(): array
    {
        return [
                'submitBtn' => [
                    'props' => [
                        'prop' => [
                            'type' => 'primary',
                            'icon' => 'el-icon-search',
                        ],
                        'confirmMsg' => '确定搜索',
                    ]
                ],
                // resetBtn 配置同 submitBtn
                'props'      => [
                    'labelWidth' => '100px',
                ],
            ];
    }

    public function columns(): array
    {
        return [
            new Input('username', '用户名'),
            new Switcher('postage', '包邮', 0),
            (new Date('section_day', '日期'))->props(
                [
                    'type'        => "datetimerange",
                    'format'      => "yyyy-MM-dd HH:mm:ss",
                    'placeholder' => "请选择活动日期",
                ]
            )
        ];
    }

    public function save():bool
    {
        return "操作成功";
    }

}
