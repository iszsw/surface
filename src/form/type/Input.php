<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\form\type;

use surface\form\Type;
use surface\form\attribute\{Col, Rule, Props};
use surface\form\FormTypeBase;

/**
 * input基类
 *
 * Class Input
 * @package Surface\form\type
 * Author: zsw zswemail@qq.com
 */
class Input extends FormTypeBase
{

    protected $type = Type::INPUT;


    public function __construct($field, $title, $value = '', $rule = null)
    {
        parent::__construct();
        $this->rule = $this->createRule($field, $title, $value, $rule);
        $this->props('type', $this->getPropsType());
    }

    protected function getPropsType()
    {
        return Type::TEXT;
    }

}