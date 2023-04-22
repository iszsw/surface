<?php

namespace surface;

/**
 * 组件基类
 * 所有组件必须继承本类
 *
 * @property array $children
 *
 * @method $this el(string $el) 标签名
 * @method $this children(string|int|array|Component|Functions $el) Functions类型的渲染时会立即执行 返回值中可以继续返回component的json对象渲染子组件
 * @method $this props(array|string $props, $value = '') 属性
 * @method $this slot(string $slot) 插槽
 *
 * @package surface
 */
class Component implements \JsonSerializable
{

    use EventTrait;

    use ViewTrait;

    /**
     * 全局事件注入字段名
     */
    const EVENT = '__event';

    /**
     * 渲染时触发
     * 回调参数 (Surface $surface:当前容器)
     */
    const EVENT_VIEW = 'view';

    // 组件名称
    protected string $name;

    protected Config $config;

    /**
     * 自定义组件渲染函数
     * [Component::COMPONENT_INVOKE => Functions::create("return {...}")]
     *  Functions中返回一个Component渲染
     */
    const COMPONENT_INVOKE = "__invoke";

    /**
     * @param array|string $config 组件名或者组件配置
     */
    public function __construct( array|string $config = [] )
    {
        $this->config = new Config();

        $this->listen(self::EVENT_VIEW, function (Surface $surface){
            $this->triggerAllSub($this->children, self::EVENT_VIEW, [$surface]);
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
    protected function triggerAllSub($children, string $event, $params = null): void
    {
        if (is_array($children)) {
            foreach ($children as $child){
                $this->triggerAllSub($child, $event, $params);
            }
        } elseif ($children instanceof self) {
            $children->trigger($event, $params);
        }
    }

    /**
     * ref创建一个全局响应式对象
     * 仅创建一个响应式对象  如果需要绑创建并绑定 ["ref:name" => "value"]
     *
     * @param string $name
     * @param mixed  $value
     *
     * @return $this
     */
    public function ref(string $name, mixed $value = null):self
    {
        return $this->listen(self::EVENT_VIEW, function (Surface $surface) use ($name, $value) {
            return $surface->ref($name, $value);
        });
    }

    /**
     * reactive创建一个全局响应式对象
     * 仅创建一个响应式对象  如果需要绑创建并绑定 ["reactive:name" => [1,2,3]]
     *
     * @param string $name
     * @param array  $value
     *
     * @return $this
     */
    public function reactive(string $name, array $value = []):self
    {
        return $this->listen(self::EVENT_VIEW, function (Surface $surface) use ($name, $value) {
            return $surface->reactive($name, $value);
        });
    }

    /**
     * 绑定v-model
     * 绑定格式 v-model:attr:name
     * 如果不存在 'name' 将自动注册ref响应式对象
     *
     * @param mixed  $value 如果全局存在变量不会该值无效
     * @param string $attr 当前组件的参数名
     * @param string $name 绑定到全局的变量名称 不存在时候将会创建 支持深度绑定 userinfo.name
     * 注意：如果是 name 参数是ref对象需要通过.value获取，系统做了自动获取但是对象属性存在value可能会出现错误
     *
     * @return $this
     */
    public function vModel( mixed $value = null, string $attr = 'modelValue', string $name = ''): self
    {
        return $this->props(["v-model:$attr:".($name?:$attr) => $value]);
    }

}

