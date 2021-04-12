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

    /**
     * 配置名 默认读取文件名
     *
     * @var string
     */
    protected $configName;

    /**
     * 组件类型 table|form
     *
     * 默认读取目录
     *
     * @var string
     */
    protected $componentType;

    public function __construct(array $config = [])
    {
        if (is_null($this->configName)) {
            $this->configName = Helper::snake(pathinfo(get_called_class())['filename']);
        }
        if (is_null($this->componentType)) {
            $this->componentType = Helper::snake(explode('\\',get_called_class())[1]);
        }

        $this->config = new Config();

        if (method_exists($this, 'init')) $this->init();

        $custom = Factory::configure($this->componentType .'.'. $this->configName, []);
        if (count($custom) > 0)
            $this->config->set($custom);

        if (count($config) > 0)
            $this->config->set($config);


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

