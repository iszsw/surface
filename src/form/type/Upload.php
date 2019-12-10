<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\form\type;

use surface\form\FormTypeBase;
use surface\form\Type;

class Upload extends FormTypeBase
{
    protected $type = Type::UPLOAD;
    public function __construct($field, $title, $value = [], $rule = null)
    {
        parent::__construct();
        $this->rule = $this->createRule($field, $title, $value, $rule);
    }

    public function init($self): void
    {
        if( !$this->props('action') ){
            $this->props('action', ''); // 配置默认值
        }
    }

}