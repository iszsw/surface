<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\form\type;

use surface\form\FormTypeBase;
use surface\form\Type;

class Tree extends FormTypeBase
{

    protected $type = Type::TREE;

    public function __construct($field, $title, $value = [], $rule = null)
    {
        parent::__construct();
        $this->rule = $this->createRule($field, $title, $value, $rule);
    }


}