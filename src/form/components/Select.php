<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\form\components;

use surface\form\FormTypeBase;
use surface\form\Type;

class Select extends FormTypeBase
{

    protected $type = Type::SELECT;

    public function __construct($field, $title, $value = [], $rule = null)
    {
        parent::__construct();
        $this->rule = $this->createRule($field, $title, $value, $rule);
    }

    /**
     * 1, man, false
     * [1=>'man', 2=>'woman']
     * [[1,'man', 'false'], 2=>'woman']
     *
     * @param $key
     * @param string $val
     * @param bool $disabled
     * @return $this
     * Author: zsw zswemail@qq.com
     */
    public function addOptions($key, $val = '', $disabled = false)
    {
        $options = [];
        if (is_array($key)){
            foreach ($key as $k=>$v) {
                if (is_array($v)){
                    call_user_func_array([$this, 'addOptions'], $v);
                }else{
                    $options[] = is_array($v) ? $v : ['value' => $k, 'label' => $v, 'disabled' => $disabled];
                }
            }
        }else{
            $options[] = ['value' => $key, 'label' => $val, 'disabled' => $disabled];
        }
        if (count($options) > 0){
            $this->rule->options = array_merge($this->rule->options, $options);
        }

        return $this;
    }


}