<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\form\components;

use surface\form\FormTypeBase;
use surface\form\Type;

class Switcher extends FormTypeBase
{

    protected $type = Type::SWITCHER;

    public function __construct($field, $title, $value = '', $rule = null)
    {
        parent::__construct();
        $this->rule = $this->createRule($field, $title, $value, $rule);
    }

    /**
     * 设置开关的值
     *
     * @param string $inactiveValue 关
     * @param string $activeValue 开
     * @return $this
     * Author: zsw zswemail@qq.com
     */
    public function addOptions($inactiveValue = '', $activeValue = null)
    {
        if (!is_array($inactiveValue)){
            $keys = [$inactiveValue, $activeValue];
            $values = [];
        }else{
            if (isset($inactiveValue[0])) { //如果为数字格式自动对值进行排序
                ksort($inactiveValue);
            }
            $keys = array_keys($inactiveValue);
            $values = array_filter(array_values($inactiveValue));
        }
        if (count($keys) === 2) {
            $this->props('activeValue', $keys[1]);
            $this->props('inactiveValue', $keys[0]);
        }
        if (count($values) === 2) {
            $this->props('activeText', $values[1]);
            $this->props('inactiveText', $values[0]);
        }
        return $this;
    }


}