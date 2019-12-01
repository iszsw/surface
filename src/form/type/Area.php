<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\form\type;


class Area extends Cascader
{

    public function __construct($field, $title, $value = [''], $rule = null)
    {
        parent::__construct($field, $title, $value, $rule);
        $this->props('options', 'eval(window["province_city_area"])');
    }

    public function init($self):void
    {
        $self->addScript('<script src="https://unpkg.com/form-create@1.6.1/district/province_city_area.js"></script>');
    }

}