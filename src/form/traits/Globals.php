<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\form\traits;

/**
 * Trait Globals
 * @package Surface\form\traits
 * Author: zsw zswemail@qq.com
 */
trait Globals
{

    protected $globals;

    public function globals($key = '', $val = '')
    {
        if ($val === '') {
            if ($key === '') {
                return $this->config['globals'];
            } elseif (is_string($key)) {
                return $this->config['globals'][$key];
            } elseif (is_array($key)) {
                $this->config['globals'] = call_user_func_array([$this, 'globals'], $key);
            }
        } else {
            $this->config['globals'][$key] = $val;
        }
        return $this;
    }
}