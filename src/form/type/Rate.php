<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\form\type;

use surface\form\FormTypeBase;
use surface\form\Type;

/**
 * 评分
 *
 * Class Rate
 * @package surface\form\type
 * Author: zsw zswemail@qq.com
 */
class Rate extends FormTypeBase
{

    protected $type = Type::RATE;

    public function __construct($field, $title, $value = 0, $rule = null)
    {
        parent::__construct();
        $this->rule = $this->createRule($field, $title, $value, $rule);
    }

}