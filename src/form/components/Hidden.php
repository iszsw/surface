<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\form\components;

use surface\form\FormTypeBase;
use surface\form\Type;

class Hidden extends FormTypeBase
{

    protected $type = Type::HIDDEN;

    public function __construct($field, $title = '', $value = '', $rule = null)
    {
        parent::__construct();
        $this->rule = $this->createRule($field, '', $value, $rule);
    }

}