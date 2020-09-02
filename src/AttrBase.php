<?php
/*
 * Author: zsw zswemail@qq.com
 */

namespace surface;

use surface\helper\Helper;

/**
 * Class AttrBase
 *
 * @package Surface
 * Author: zsw zswemail@qq.com
 */
abstract class AttrBase implements \ArrayAccess, \JsonSerializable , \IteratorAggregate
{
    protected $attr = [];

    public function __construct($default = [])
    {
        $this->attr = $this->attr();
        if (is_array($default) && count($default) > 0) {
            foreach ($default as $name => $val) {
                $this->attr[$name] = $val;
            }
        }
    }

    public function __get($name)
    {
        return $this->attr[$name] ?? '';
    }

    public function __set($name, $value)
    {
        $this->attr[$name] = $value;
        return $this;
    }

    public function __isset($name)
    {
        return isset($this->attr[$name]);
    }

    public function __unset($name)
    {
        unset($this->attr[$name]);
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
        return $this->attr;
    }

    /**
     * 获取修改过的值
     * Author: zsw zswemail@qq.com
     */
    public function getEdited()
    {
        $current = $this->toArray();
        $default = $this->attr();
        foreach ($default as $key => $val) {
            if (isset($current[$key]) && $current[$key] == $val) {
                unset($current[$key]);
            }
        }
        return $current;
    }

    public function toArray($filter = true)
    {
        $data = $this->getIterator()->getArrayCopy();
        return $filter ? Helper::filterEmpty($data) : $data;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->attr);
    }

    public function __invoke($config = [])
    {
        if (is_array($config)) {
            foreach ($config as $name=>$value) {
                $this->attr[$name] = $value;
            }
        }
        return $this;
    }

    /**
     * 返回参数值
     *
     * @return array
     */
    abstract protected function attr(): array;

}