<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\form\type;

use surface\form\FormTypeBase;
use surface\form\Type;

/**
 * 选择项
 * Class Tab
 * @package Surface\form\type
 * Author: zsw zswemail@qq.com
 */
class Tab extends FormTypeBase
{

    protected $type = Type::TAB;

    public function __construct($field='', $title='', $value = '', $rule = null)
    {
        parent::__construct();
        $this->rule = $this->createRule($field, $title, $value, $rule);
    }

}