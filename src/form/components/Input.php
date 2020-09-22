<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\form\components;

use surface\form\FormTypeBase;
use surface\form\Type;

/**
 * input基类
 *
 * Class Input
 * @package surface\form\components
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