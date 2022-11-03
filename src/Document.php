<?php

namespace surface;


/**
 * Html Document生成
 */
class Document
{

    use EventTrait;

    /**
     * append时触发
     * 回调参数 (Surface $surface)
     */
    const EVENT_CREATE = 'create';

    /**
     * view、display渲染时触发
     * 回调参数 (Surface $surface)
     */
    const EVENT_VIEW = 'view';

    /**
     * 组件名称
     *
     * @var string
     */
    protected string $name = 'span';


    private string $vModelKey = '__DEFAULT_KEY';

    /**
     * 组件v-model属性值 一个surface实例下唯一
     *
     * @var array
     */
    protected array $vModel = [];

    protected array $children = [];

    protected Config $attr;
    protected Config $bind;

    public function __construct($name = null)
    {
        if ($name) {
            $this->name = $name;
        }

        $this->attr = new Config();
        $this->bind = new Config();

        foreach ([self::EVENT_CREATE, self::EVENT_VIEW] as $event) {
            $this->listen($event, function (Surface $surface) use ($event){
                $this->triggerAllSub($this->children, $event, [$surface]);
            }, false);
        }

        if (method_exists($this, 'init')) $this->init();
    }

    /**
     * @param Config $config
     * @param array  $data
     *
     * @return $this
     */
    protected function config(Config $config, array $data): self
    {
        call_user_func_array($config, $data);
        return $this;
    }

    /**
     * 绑定html标签上的属性
     *
     * @param array $data
     *
     * @return $this
     */
    public function attrs(array ...$data): self
    {
        return $this->config($this->attr, $data);
    }

    /**
     * 绑定到data中的变量
     *
     * @param array $data
     *
     * @return $this
     */
    public function binds(array ...$data): self
    {
        return $this->config($this->bind, $data);
    }

    /**
     * 设置标签名称
     *
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * 自定义v-model绑定的变量名
     *
     * @param string $vModel
     *
     * @return $this
     */
    public function setVModel(string $vModel, string $name = ''): self{
        $this->vModel[$name ?: $this->vModelKey] = $vModel;
        return $this;
    }

    /**
     * 获取v-model绑定的变量名
     *
     * @param  string  $name
     *
     * @return string
     */
    public function getVModel(string $name = ''): string {
        return $name ? ($this->vModel[$name] ?? '') : $this->vModel[$this->vModelKey] ?? '';
    }

    /**
     * 启用 v-model 绑定
     *
     * @param $def null VModel默认值
     * @param string $name 具名
     *
     * @return $this
     */
    public function vModel($def = null, string $name = '' ): self
    {
        $name = $name ?: $this->vModelKey;
        if (!$this->getVModel($name)) {
            $this->setVModel(Surface::uuid(), $name);
        }
        $this->listen(self::EVENT_VIEW, function (Surface $surface) use ($def, $name) {
            // 延迟执行
            $this->attrs(['v-model' . (($name && $name !== $this->vModelKey) ? ":$name" : "")=> $this->getVModel($name)])->binds(['ref:'.$this->getVModel($name)=>$def]);
        });
        return $this;
    }

    /**
     * 添加子节点
     *
     * @param string|array|Document $children
     *
     * @return $this
     */
    public function appendChild( $children ): self
    {
        if (is_array($children)) {
            array_map([$this, 'appendChild'], $children);
        }else if($children instanceof self || is_string($children)){
            $this->children[] = $children;
        }
        return $this;
    }

    private function parseChild($child)
    {
        if ($child instanceof self){
            $child = $child->getNode();
        }elseif (is_string($child) && strpos( $child, ':') === 0){
            $child = "{{ ".substr($child, 1)." }}";
        }
        return $child;
    }

    private function getChildNode(string $node, $child): string
    {
        return $node . $this->parseChild($child);
    }

    /**
     * 获取所有节点
     *
     * @return string
     */
    public function getNode():string {
        return array_reduce($this->children, [$this, 'getChildNode'], "<{$this->name} {$this->getAttrStr()}>") . "</{$this->name}>";
    }

    private function getAttrStr():string
    {
        $data = [];
        $attrs = $this->attr->toArray();
        foreach ($attrs as $k => $attr) {
            $data[]= is_numeric($k) ? $attr : "{$k}=\"{$attr}\"";
        }
        return implode(' ', $data);
    }

    private function getChildData(array $data, $child): array
    {
        if ($child instanceof self) {
            $data = array_merge($data, $child->getBind());
        }
        return $data;
    }

    private function parseBind($bind)
    {
        if ($bind instanceof IFormat) {
            $bind = $bind->format();
        }
        return $bind;
    }

    /**
     * 获取data绑定参数
     *
     * @return array
     */
    public function getBind():array {
        $data = [];
        $binds = $this->bind->toArray();
        foreach ($binds as $key => $bind) {
            $data[$key] = $this->parseBind($bind);
        }
        return array_reduce($this->children, [$this, 'getChildData'], $data);
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

