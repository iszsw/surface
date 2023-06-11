<?php

namespace surface;


class Surface
{

    use EventTrait;


    /**
     * 渲染时触发
     * 回调参数 (Surface $surface:当前容器)
     */
    const EVENT_VIEW = 'view';

    /**
     * 唯一标识
     *
     * @var string
     */
    protected string $id;

    protected array $script = [];

    protected array $style = [];

    /**
     * @var array<Functions>
     */
    private array $registers = [];

    /**
     * @var array<Functions>
     */
    private array $setups = [
        'before' => [], // 数据初始化之前执行（初始化变量）
        'after' => [], // 数据初始化之后执行（对象赋值等）
    ];

    /**
     * @var array<Component>
     */
    private array $components = [];

    /**
     * 已经导入依赖文件
     *
     * @var bool
     */
    private bool $importDependent = false;

    /**
     * 设置自定义主题 如果未设置默认为 Element-plus
     *
     * @var bool
     */
    private bool $importTheme = false;

    /**
     * 全局配置
     *
     * @var array
     */
    private array $config = [];

    /**
     * 组件库依赖
     *
     * @var array
     */
    private array $uses = [];

    public function __construct()
    {
        $this->init();
    }

    /**
     * 添加组件
     *
     * @param  Component|Functions  $component
     * @param  bool  $unshift
     *
     * @return $this
     */
    public function append(Component|Functions $component, bool $unshift = false): self
    {
        if ($component instanceof Functions) {
            $component = (new Component())->children([[Component::COMPONENT_INVOKE => $component]]);
        }

        if ($unshift) {
            array_unshift($this->components, $component);
        }else{
            $this->components[] = $component;
        }
        return $this;
    }

    protected function init() {}

    /**
     * 调用 app.use 注册组件库到 app
     *
     * @param string $name
     * @param null|string $config 配置参数原样绑定 '{size: "default"}'
     *
     * @return $this
     */
    public function use(string $name, ?string $config = null): self
    {
        $this->uses[] = [
            'name' => $name,
            'config' => $config
        ];

        return $this;
    }

    /**
     * vue初始化调用
     * 初始化的时候调用 作为全局引入样式等
     *
     * fn(app):void
     *
     * @param Functions $fn
     *
     * @return $this
     */
    public function register(Functions $fn): self
    {
        $this->registers[] = $fn;

        return $this;
    }

    /**
     * 自定义主题引入
     *
     * @return $this
     */
    public function customTheme(): self
    {
        $this->importTheme = true;
        return $this;
    }

    /**
     * 自定义依赖引入
     * 启用了自定义依赖同时也不会执行自定义主题
     *
     * @return $this
     */
    public function customDependent(): self
    {
        $this->importDependent = true;
        return $this;
    }


    public function config(array $config): self
    {
        $this->config = array_merge($this->config, $config);
        return $this;
    }

    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * 注册配置
     *
     * @return void
     */
    protected function registerConfig()
    {
        $config = $this->toJson($this->getConfig());
        $this->register(Functions::create("Surface.config({$config})", ['app']));
    }

    /**
     * 初始化data中的数据
     *
     * fn(data):void
     *
     * @param Functions $fn
     * @param Bool $before  数据初始化之前执行（初始化变量）
     *
     * @return $this
     */
    public function setup(Functions $fn, bool $before = false): self
    {
        $this->setups[$before ? 'before' : 'after'][] = $fn;

        return $this;
    }

    /**
     * 添加Javascript
     *
     * @param $script   $script|[$script => $sort]
     * @param int $sort 资源文件插入的位置
     * @param bool $cover 覆盖指定排序的sort
     *
     * @return $this
     */
    public function addScript($script, int $sort = 8, bool $cover = false): self
    {
        return $this->addResources($script, 'script', $sort, $cover);
    }

    /**
     * 添加样式
     *
     * @param $style    $style|[$style => $sort]
     * @param int $sort 资源文件插入的位置
     * @param bool $cover 整个sort完全覆盖
     *
     * @return $this
     */
    public function addStyle($style, int $sort = 8, bool $cover = false): self
    {
        return $this->addResources($style, 'style', $sort, $cover);
    }

    protected function addResources($resource, string $type = 'script', int $sort = 8, bool $cover = false): self
    {
        if (is_array($resource))
        {
            foreach ($resource as $res => $so)
            {
                $this->addResources(is_numeric($res) ? $so : $res, $type, is_numeric($so) ? $so : $sort, $cover);
            }
        } else
        {
            if ($type === 'script')
            {
                foreach ($this->script as $so => $script) {
                    if (false !== $index = array_search($resource, $script)) {
                        unset($this->script[$so][$index]);
                    }
                }
                if ($cover) {
                    $this->script[$sort] = [$resource];
                }else{
                    $this->script[$sort][] = $resource;
                }
            } else
            {
                foreach ($this->style as $so => $style) {
                    if (false !== $index = array_search($resource, $style)) {
                        unset($this->style[$so][$index]);
                    }
                }
                if ($cover) {
                    $this->style[$sort] = [$resource];
                }else{
                    $this->style[$sort][] = $resource;
                }
            }
        }

        return $this;
    }

    /**
     * @param int $len
     *
     * @return string
     */
    public static function uuid(int $len = 6): string
    {
        $chars = array( "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
        shuffle ( $chars ); // 将数组打乱
        $str = '';
        $charLen = count($chars) - 1;
        for ($i = 0; $i < $len; $i ++) {
            $str .= $chars[mt_rand ( 0, $charLen) ];
        }
        return $str;
    }

    /**
     * 获取唯一Key
     *
     * @return string
     */
    public function id(): string
    {
        if (empty($this->id))
        {
            $this->id = self::uuid();
        }

        return $this->id;
    }

    /**
     * 返回当前组件所有对象
     *
     * @return string
     */
    public function data():string
    {
        return "window.Surface.{$this->id()}";
    }

    /**
     * 获取样式
     *
     * @return array
     */
    public function getStyle(): array
    {
        ksort($this->style);
        return array_merge(...$this->style);
    }

    /**
     * 获取Javascript
     *
     * @return array
     */
    public function getScript(): array
    {
        ksort($this->script);
        return array_merge(...$this->script);
    }

    /**
     * @param  array|\JsonSerializable  $array
     *
     * @return string
     */
    private function toJson( $array ):string
    {
        return json_encode($array, JSON_UNESCAPED_UNICODE);
    }


    /**
     * 导入主题 默认使用 Element-plus
     *
     * @return void
     */
    private function importTheme()
    {
        if (!$this->importTheme) {
            $this->addStyle(
                [
                    '<link href="//unpkg.com/element-plus/dist/index.css" rel="stylesheet">' => 1,
                ]
            );
            $this->importTheme = true;
        }
    }

    /**
     * 核心依赖
     */
    private function importDependent(){
        if (!$this->importDependent) {
            $this->addScript(
                [
                    '<script src="//unpkg.com/vue@3"></script>' => 0,
                    '<script src="//unpkg.com/element-plus"></script>' => 1,
                    '<script src="//unpkg.com/@element-plus/icons-vue"></script>' => 2,
                    '<script src="//unpkg.com/element-plus/dist/locale/zh-cn"></script>' => 3,
                ]
            );

            $this->addScript('<script src="//unpkg.com/surface-plus"></script>', 16);

            $this->use("ElementPlus", '{locale: ElementPlusLocaleZhCn, size: "default"}');

            $this->importDependent = true;
        }
    }

    protected function registerUse(){
        $useStr = "";
        foreach ($this->uses as $use) {
            $name = $use['name'];
            $config = $use['config'] ?? "{}";
            $useStr .= "app.use($name, $config);";
        }
        $this->register(Functions::create($useStr, ['app']));
    }

    protected function beforeDisplay() :void
    {
        $this->use('Surface');

        $this->registerUse();

        $this->registerConfig();
    }

    protected function beforeView() :void
    {
        $this->importDependent();

        $this->importTheme();

        $this->trigger(self::EVENT_VIEW, [$this]);
    }

    /**
     * 生成代码
     * 不包括样式和依赖的js
     *
     * @return string
     */
    public function display(): string
    {
        foreach ($this->components as $component)
        {
            $component->trigger(Component::EVENT_VIEW, [$this]);
        }

        $this->beforeDisplay();

        $registers = [];
        foreach ($this->registers as $register)
        {
            $registers[] = $register->format();
        }

        $setups = [
            'before' => [],
            'after' => [],
        ];

        foreach ($this->setups['before'] as $setup)
        {
            $setups['before'][] = $setup->format();
        }

        foreach ($this->setups['after'] as $setup)
        {
            $setups['after'][] = $setup->format();
        }

        $id = $this->id();
        $setups = $this->toJson($setups);
        $registers = $this->toJson($registers);
        $components = $this->toJson($this->components);

        ob_start();
        include dirname(__FILE__).DIRECTORY_SEPARATOR.'template'.DIRECTORY_SEPARATOR.'display.php';

        return ob_get_clean();
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
        switch (true){
            case $value instanceof \stdClass:
            case is_array($value):
                $value = json_encode($value, JSON_UNESCAPED_UNICODE);
                break;
            case is_string($value):
            case $value instanceof \Stringable:
                $value = "'".((string)$value)."'";
                break;
        }
        return $this->setup(Functions::create("return data.{$name} = Vue.ref($value)", ['data']), true);
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
        $value = json_encode($value, JSON_UNESCAPED_UNICODE);
        return $this->setup(Functions::create("return data.{$name} = Vue.reactive($value)", ['data']), true);;
    }

    /**
     * 生成页面
     *
     * @return string
     */
    public function view(): string
    {
        $this->beforeView();

        $content = $this->display();

        // 只能在display之后调用
        $styles = implode("\r\n", $this->getStyle());

        $scripts = implode("\r\n", $this->getScript());

        ob_start();
        include dirname(__FILE__).DIRECTORY_SEPARATOR.'template'.DIRECTORY_SEPARATOR.'view.php';
        return ob_get_clean();
    }

}



