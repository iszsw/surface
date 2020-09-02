<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\form\components;

use surface\form\FormTypeBase;
use surface\form\Type;

class ColorPicker extends FormTypeBase
{

    protected $type = Type::COLOR_PICKER;

    public function __construct($field, $title, $value = [], $rule = null)
    {
        parent::__construct();
        $this->rule = $this->createRule($field, $title, $value, $rule);
    }
}