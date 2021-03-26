<?php

namespace surface;

/**
 *
 * Class Component
 *
 * @method $this el($el)
 * @method $this slot($slot)
 * @method $this props($key, $value)
 * @method $this style($key, $value)
 * @method $this class($class)
 * @method $this attrs($key, $value)
 * @method $this domProps($key, $value)
 * @method $this children(array $children)
 * @method $this scopedSlots(array $scopedSlots)
 *
 * @package surface\table
 * Author: zsw zswemail@qq.com
 */
class Component
{

    /**
     * @var Config
     */
    protected $config;

    public function __construct(array $config = [])
    {
        $this->config = new Config($config);

        if (method_exists($this, 'init')) $this->init();
    }

    public function __call($attr, $arguments)
    {
        $name  = $arguments[0] ?? '';
        $config = $arguments[1] ?? null;
        if (!is_array($name) && !is_null($config)) {
            $name = [$name => $config];
        }
        $this->config->set($attr, $name);
        return $this;
    }

    public function __get($attr)
    {
        return $this->config->get($attr);
    }

    public function __set($name, $value)
    {
        return $this->__call($name, [$value]);
    }

    /**
     * 子组件回调
     * @var callback
     */
    private $formatCallback;

    /**
     * @param callback $callback
     *
     * @return array
     */
    final public function format( $callback = null ): array
    {
        $config = $this->config->toArray();

        $this->formatCallback = $callback;

        foreach (['scopedSlots', 'children'] as $type)
            if (isset($config[$type]))
                $config[$type] = array_map([$this, 'formatComponent'], $config[$type]);


        is_callable($this->formatCallback) && call_user_func($this->formatCallback, $this);

        return $this->afterFormat($config);
    }

    protected function afterFormat(array $config):array
    {
        return $config;
    }

    /**
     * @param array | Component  $component 最多一层
     *
     * @return array
     */
    protected function formatComponent( $component )
    {
        return $component instanceof Component ? $component->format($this->formatCallback) : $component;
    }

}

