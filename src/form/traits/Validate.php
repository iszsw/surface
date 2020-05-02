<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\form\traits;

use surface\form\attribute\Validate as ValidateAttr;

/**
 * input基类
 *
 * Class Input
 * @package surface\form\type
 * Author: zsw zswemail@qq.com
 */
trait Validate
{

    protected $validate = [];

    /**
     * 不能为空, true, blur
     * [[不能为空, true, blur], [不能为空, true, blur]]
     * ['message' => "版本号格式错误", 'pattern'=>"\d+\.\d+\.\d+"]
     * ['type' => 'url', 'message' => "必须链接", 'required'=>false]
     * [['message'=>'不能为空', 'required'=>'true', 'trigger'=>'blur'], ['message'=>'不能为空', 'required'=>'true', 'trigger'=>'blur']]
     *
     * @param string $message
     * @param bool $required
     * @param string $type
     * @return $this
     */
    public function validate($message = null, $required = true, $type = 'string')
    {
        if (null === $message) {
            return $this->validate;
        } else if (is_array($message)) {
            foreach ($message as $val) {
                if (is_array($val)){
                    if (isset($val[0])) {
                        call_user_func_array([$this, 'validate'], $val);
                    }else{
                        call_user_func([$this, 'validate'], $val);
                    }
                } else {
                    array_push($this->validate, new ValidateAttr($message));break;
                }
            }
        }else{
            $message = $this->rule->title . '不能为空';
            array_push($this->validate, new ValidateAttr(['required'=>$required, 'message'=>$message, 'type'=>$type]));
        }

        return $this;
    }


}