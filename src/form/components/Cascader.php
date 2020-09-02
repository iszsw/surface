<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\form\components;

use surface\form\FormTypeBase;
use surface\form\Type;

class Cascader extends FormTypeBase
{

    protected $type = Type::CASCADER;

    public function __construct($field, $title, $value = [''], $rule = null)
    {
        parent::__construct();
        $this->rule = $this->createRule($field, $title, $value, $rule);
    }

    public function init($self): void
    {
        // 值初始化
        $this->rule->value || $this->rule->value = [''];
    }

    public function addOptions($key, $val = '')
    {
        $options = [];
        if (is_array($key)){
            foreach ($key as $k=>$v) {
                if (is_array($v) && isset($v[0])){
                    call_user_func([$this, 'addOptions'], $v);
                }else{
                    $val = array_merge(['value' => $k, 'label' => $v], $this->props('lazy') ? ['children' => ['']] : []);
                    $options[] = is_array($v) ? $v : $val;
                }
            }
        }else{
            $options[] = array_merge(['value' => $key, 'label' => $val], $this->props('lazy') ? ['children' => ['']] : '');
        }
        if (is_null($this->props)) {
            $this->props();
        }
        if (count($options) > 0){
            $this->props->options = array_merge($this->props->options ?? [], $options);
        }
        return $this;
    }

}