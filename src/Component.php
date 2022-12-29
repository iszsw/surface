<?php

namespace surface;

/**
 * 组件基类
 * 所有组件必须继承本类
 *
 * @property array $children
 *
 * @method self el(string $el)
 * @method self children(string|int|array|self|Functions $el) Functions类型的渲染时会立即执行 返回值中可以继续返回component的json对象渲染子组件
 * @method self props(array $props) 属性
 * @method self slot(string $slot) 插槽
 *
 * @package surface
 */
class Component implements \JsonSerializable
{

    use EventTrait;

    use ViewTrait;

    /**
     * 渲染时触发
     * 回调参数 (Surface $surface:当前容器)
     */
    const EVENT_VIEW = 'view';

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
     *
     * @param string $name
     * @param mixed  $value
     *
     * @return $this
     */
    public function ref(string $name,mixed $value):self
    {
        $this->listen(self::EVENT_VIEW, function (Surface $surface) use ($name, $value) {
            switch (true){
                case is_array($value):
                    $value = json_encode($value, JSON_UNESCAPED_UNICODE);
                    break;
                case is_string($value):
                case $value instanceof \Stringable:
                    $value = "'{(string)$value}'";
                    break;
            }
            $surface->setup(Functions::create("return data.{$name} = Vue.ref($value)", ['data']));
        });
        return $this;
    }

    /**
     * reactive创建一个全局响应式对象
     *
     * @param string $name
     * @param array  $value
     *
     * @return $this
     */
    public function reactive(string $name, array $value):self
    {
        $this->listen(self::EVENT_VIEW, function (Surface $surface) use ($name, $value) {
            $value = json_encode($value, JSON_UNESCAPED_UNICODE);
            $surface->setup(Functions::create("return data.{$name} = Vue.reactive($value)", ['data']));
        });
        return $this;
    }

    /**
     * 绑定v-model
     * 绑定格式 v-model:modelValue:name
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
        $this->props(["v-model:$attr:".($name?:$attr) => $value]);
        return $this;
    }

}

