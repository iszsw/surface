<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\form\components;

use surface\form\FormTypeBase;
use surface\form\Type;

class Frame extends FormTypeBase
{

    protected $type = Type::FRAME;

    public function __construct($field, $title, $value = [], $rule = null)
    {
        parent::__construct();
        $this->props('handleIcon', true);
        $this->rule = $this->createRule($field, $title, $value, $rule);
    }


}