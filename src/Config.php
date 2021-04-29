<?php
/*
 * Author: zsw zswemail@qq.com
 */

namespace surface;

use surface\Helper;

/**
 * 配置服务
 *
 * Class Config
 *
 * @package Surface
 */
class Config implements \ArrayAccess, \JsonSerializable , \IteratorAggregate
{
    protected $config = [];

    public function __construct(?array $default = [])
    {
        $this->config = $default ?? [];
    }

    public function __get($name)
    {
        return $this->get($name);
    }

    public function __set($name, $value)
    {
        return $this->set($name, $value);
    }

    public function __isset($name)
    {
        return $this->has($name);
    }

    public function __unset($name)
    {
        unset($this->config[$name]);
    }

    public function offsetExists($offset)
    {
        return $this->__isset($offset);
    }

    public function offsetGet($offset)
    {
        return $this->__get($offset);
    }

    public function offsetSet($offset, $value)
    {
        return $this->__set($offset, $value);
    }

    public function offsetUnset($offset)
    {
        return $this->__unset($offset);
    }

    public function jsonSerialize()
    {
        return $this->config;
    }

    /**
     * 获取配置参数 为空则获取所有配置
     * @access public
     * @param  string $name    配置参数名（支持多级配置 .号分割）
     * @param  mixed  $default 默认值
     * @return mixed
     */
    public function get(string $name = null, $default = null)
    {
        // 无参数时获取所有
        if (empty($name)) {
            return $this->config;
        }

        if (false === strpos($name, '.')) {
            return $this->pull($name, $default);
        }

        $name    = explode('.', $name);
        $name[0] = strtolower($name[0]);
        $config  = $this->config;

        // 按.拆分成多维数组进行判断
        foreach ($name as $val) {
            if (isset($config[$val])) {
                $config = $config[$val];
            } else {
                return $default;
            }
        }

        return $config;
    }


    /**
     * 设置配置参数 name为数组则为批量设置
     * @access public
     * @param  string $name 配置名
     * @param  array|string  $val 配置参数
     * @return array
     */
    public function set($name, $val = null)
    {
        if (is_array($name) && $val == null) {
            foreach ($name as $k => $v) {
                $this->set($k, $v);
            }
        }else if(is_string($name)){
            $name   = explode('.', $name);
            $config = [];
            $nameLength = count($name);
            foreach ($name as $k => $n) {
                if ($nameLength == $k + 1) {
                    $config[$n] = $val;
                }else{
                    $config[$n] = [];
                }
            }
            $this->config = $this->recursive($this->config, $config);
        }

        return $this->config;
    }

    /**
     * 数组深度合并 相同KEY值 如果是数组合并 如果是字符串覆盖
     *
     * @param array $original
     * @param array $extend
     *
     * @return array
     */
    private function recursive(array $original, array $extend):array
    {
        foreach ($extend as $k => $v) {
            $original[$k] = isset($original[$k]) && is_array($original[$k]) ? $this->recursive($original[$k], (array)$v) : $v;
        }
        return $original;
    }

    /**
     * 检测配置是否存在
     * @access public
     * @param  string $name 配置参数名（支持多级配置 .号分割）
     * @return bool
     */
    public function has(string $name): bool
    {
        return !is_null($this->get($name));
    }

    /**
     * 获取一级配置
     * @access protected
     * @param  string $name 一级配置名
     * @param null   $default
     *
     * @return mixed|null
     */
    protected function pull(string $name, $default = null)
    {
        $name = strtolower($name);
        return $this->config[$name] ?? $default;
    }

    public function toArray()
    {
        return $this->getIterator()->getArrayCopy();
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->config);
    }

    public function __invoke($config = [])
    {
        if (is_array($config)) {
            foreach ($config as $name=>$value) {
                $this->config[$name] = $value;
            }
        }
        return $this;
    }

}
