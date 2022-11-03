<?php

namespace surface;

/**
 * 组件基类
 * 所有组件必须继承本类
 *
 * @property array $children
 *
 * @method self el(string $el)
 * @method self children(string|int|array $el)
 * @method self props(array $props) 属性
 * @method self slot(string $slot) 插槽
 *
 * @package surface
 */
class Component implements \JsonSerializable
{

    /**
     * 渲染时触发
     *
     * 回调参数 (Document $document, Surface $surface)
     */
    const EVENT_VIEW = 'view';

    use EventTrait;

    // 组件名称
    protected string $name;

    protected Config $config;

    /**
     * @param array|string $config
     *
     */
    public function __construct( $config = [] )
    {
        $this->config = new Config();

        $this->listen(self::EVENT_VIEW, function (Surface $surface, Document $document){
            $this->triggerAllSub($this->children, self::EVENT_VIEW, [$surface, $document]);
        },false);

        if (method_exists($this, 'init')) $this->init();

        if (is_string($config)){
            $config = ['el' => $config];
        }

        if (!isset($config['el'])) {
            if (!isset($this->name)) {
                $called = explode('\\', get_called_class());
                $this->name = strtolower(preg_replace('/([a-z])([A-Z])/', "$1-$2", end($called)));;
            }
            $config['el'] = $this->name;
        }

        if (count($config) > 0) {$this->config->set($config);}
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

    public function jsonSerialize(): array
    {
        return $this->config->toArray();
    }

    /**
     * 触发自己和所有下级事件
     *
     * @param        $children
     * @param string $event
     * @param null   $params
     */
    private function triggerAllSub($children, string $event, $params = null): void
    {
        if (is_array($children)) {
            foreach ($children as $child){
                $this->triggerAllSub($child, $event, $params);
            }
        } elseif ($children instanceof self) {
            $children->trigger($event, $params);
        }
    }

}

