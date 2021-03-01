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

class Search implements FormInterface
{

    public function options(): array
    {
        return [
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

    public function save()
    {
        return "操作成功";
    }

}
