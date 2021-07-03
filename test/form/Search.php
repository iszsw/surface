<?php

namespace surface\test\form;

use surface\form\components\Date;
use surface\form\components\Input;
use surface\form\components\Switcher;
use surface\helper\FormAbstract;

class Search extends FormAbstract
{

    /**
     * 配置搜索规则
     *
     * 字段 => 规则
     *
     * 根据规则组装返回where条件到Table::data方法
     *
     *
     *
     * @return array|string[]
     */
    public function rules(): array
    {
        return [
            'username' => 'LIKE',
            'postage' => '=',
            'section_day' => 'BETWEEN',
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

}
