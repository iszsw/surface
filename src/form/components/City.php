<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\form\components;

class City extends Cascader
{

    public function __construct($field, $title, array $value = [''], $rule = null)
    {
        parent::__construct($field, $title, $value, $rule);
        $this->props('options', 'eval(window["province_city"])');
    }

    public function init($self):void
    {
        $self->addScript('<script src="https://unpkg.com/form-create@1.6.1/district/province_city.js"></script>');
    }

}