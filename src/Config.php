<?php

namespace surface;

/**
 * 配置
 *
 * Class Config
 *
 * @package Surface
 */
class Config implements \ArrayAccess, \JsonSerializable , \IteratorAggregate
{
    protected array $config = [];

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

    public function offsetExists($offset): bool
    {
        return $this->__isset($offset);
    }

    public function offsetGet($offset): mixed
    {
        return $this->__get($offset);
    }

    public function offsetSet($offset, $value): void
    {
        $this->__set($offset, $value);
    }

    public function offsetUnset($offset): void
    {
        $this->__unset($offset);
    }

    public function jsonSerialize(): array
    {
        return $this->config;
    }

    /**
     * 获取配置参数 为空则获取所有配置
     *
     * @param mixed $name    配置参数名（支持多级配置 .号分割）
     * @param mixed $default 默认值
     *
     * @return mixed
     */
    public function get( $name = '', $default = null)
    {
        // 无参数时获取所有
        if (empty($name)) {
            return $this->config;
        }

        if (false === strpos($name, '.')) {
            return $this->pull($name, $default);
        }

        $name    = explode('.', $name);
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
     *
     * 数字下标(非索引数组)可能存在值被覆盖的问题
     *
     * @access public
     * @param  string $name 配置名
     * @param  array|string  $val 配置参数
     * @return array
     */
    public function set($name, $val = null)
    {
        if (is_array($name) && $val == null) {
            foreach ($name as $k => $v) {
                if ((int)$k === $k) {
                    $this->config = $this->recursive($this->config, [$v]);
                }else{
                    $this->set($k, $v);
                }
            }
        }else if( is_string($name) ){
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
        if (isset($extend[0])) {
            $original = array_merge($original, $extend);
        } else {
            foreach ($extend as $k => $v) {
                $original[$k] = isset($original[$k]) && is_array($original[$k]) ? $this->recursive($original[$k], (array)$v) : $v;
            }
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
        return $this->config[$name] ?? $default;
    }

    public function toArray(): array
    {
        return $this->getIterator()->getArrayCopy();
    }

    private function format(array $configs = []): array
    {
        foreach ($configs as &$config) {
            if ($config instanceof IFormat) {
                $config = $config->format();
            }
            if (is_array($config)) {
                $config = $this->format($config);
            }
        }
        return $configs;
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->format(($this->config)));
    }

    public function __invoke($config = []): static
    {
        if (is_array($config)) {
            $this->set($config);
        }
        return $this;
    }

}
