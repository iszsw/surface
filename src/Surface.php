<?php

namespace surface;


class Surface
{

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
    private array $setups = [];

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
    private bool $courseTheme = false;

    /**
     * 组件库依赖
     *
     * @var array
     */
    private array $use = [];

    public function __construct()
    {
        $this->init();
    }

    /**
     * 自定义主题
     *
     * @return $this
     */
    public function courseTheme(): self
    {
        $this->courseTheme = true;

        return $this;
    }

    /**
     * 添加模板
     *
     * @return $this
     */
    public function append(Component $component, bool $unshift = false): self
    {
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
     * 自定义资源依赖引入
     *
     * @return $this
     */
    public function customDependent(): self
    {
        $this->importDependent = true;
        return $this;
    }

    /**
     * 初始化data中的数据
     *
     * fn(data):void
     *
     * @param Functions $fn
     *
     * @return $this
     */
    public function setup(Functions $fn): self
    {
        $this->setups[] = $fn;

        return $this;
    }

    /**
     * 添加Javascript
     *
     * @param $script
     * @param $unshift 顶部插入
     *
     * @return $this
     */
    public function addScript($script, bool $unshift = false): self
    {
        return $this->addResources($script, 'script', $unshift);
    }

    /**
     * 添加样式
     *
     * @param $style
     * @param $unshift 顶部插入
     *
     * @return $this
     */
    public function addStyle($style, bool $unshift = false): self
    {
        return $this->addResources($style, 'style', $unshift);
    }

    protected function addResources($resource,string $type = 'script', bool $unshift = false): self
    {
        if (is_array($resource))
        {
            if ($unshift) $resource = array_reverse($resource);

            foreach ($resource as $v)
            {
                $this->addResources($v, $type, $unshift);
            }
        } else
        {
            if ($type === 'script')
            {
                if ( ! in_array($resource, $this->script))
                {
                    if ($unshift) {
                        array_unshift($this->script, $resource);
                    }else{
                        $this->script[] = $resource;
                    }
                }
            } else
            {
                if ( ! in_array($resource, $this->style))
                {
                    if ($unshift) {
                        array_unshift($this->style, $resource);
                    }else{
                        $this->style[] = $resource;
                    }
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
        return $this->style;
    }

    /**
     * 获取Javascript
     *
     * @return array
     */
    public function getScript(): array
    {
        return $this->script;
    }

    private function toJson(array|\JsonSerializable $array):string
    {
        return json_encode($array, JSON_UNESCAPED_UNICODE);
    }


    /**
     * 导入主题
     * 没有设置主题 默认使用Element-plus
     *
     * @return void
     */
    private function importTheme()
    {
        if (!$this->courseTheme) {
            $this->addScript(
                [
                    '<script src="//unpkg.com/element-plus"></script>',
                    '<script src="//unpkg.com/element-plus/dist/locale/zh-cn"></script>',
                ]
            );

            $this->addStyle(
                [
                    '<link href="//unpkg.com/element-plus/dist/index.css" rel="stylesheet">',
                ], true
            );

            $this->use("ElementPlus", '{locale: ElementPlusLocaleZhCn, size: "default"}');
        }
    }

    private function importDependent(){
        if (!$this->importDependent) {
            $this->addScript(
                [
                    '<script src="//unpkg.com/vue@3"></script>',
                    '<script src="//unpkg.com/surface-plus"></script>',
                ], true
            );

            $this->addStyle(
                [
                    '<link href="//unpkg.com/surface-plus/dist/index.css" rel="stylesheet">',
                ], true
            );

            $this->importTheme();

            $this->importDependent = true;
        }
    }

    /**
     * setup数据初始化 最先执行
     * 深度处理通过ref|reactive|v-model 前缀绑定的参数
     *
     * @return Functions
     */
    private function setupBefore() :Functions
    {
        return Functions::create(<<<JS
return (function handler(obj, global = null){
    if (typeof obj === 'object') {
        for (let i in obj) {
            if (typeof i === 'string' && i.indexOf(":") >= 0) {
                let split = i.split(":", 3)
                let func = split[0].toLocaleString()
                if (split.length > 1 && ['ref', 'reactive', 'v-model'].indexOf(func) > -1) {
                    let attrName = split[1];
                    let bindName = split[split.length === 3 ? 2 : 1];
                    let isVModel = func === 'v-model'
                    // 深度绑定
                    let attrs = bindName.split(".");
                    let varName = attrs[0];
                    func = isVModel ? 'ref' : func
                    // ref 自动加上value
                    if (func === 'ref' && attrs[1] !== 'value') {
                        attrs.splice(1, 0, 'value')
                        bindName = attrs.join('.')
                    }
                    if (!data.hasOwnProperty(varName)) {
                        data[varName] = Vue[func](obj[i])
                    }
                    let onUpdateName = 'onUpdate:' + attrName;
                    if (isVModel && !obj.hasOwnProperty(onUpdateName)) {
                        obj[onUpdateName] = item => {
                            try{
                                eval("(data."+bindName+" = item)")
                            }catch (e) {
                                console.error("[ SURFACE ] 变量解析失败："+bindName, e)
                            }
                        }
                    }
                    let _bind = () => {
                        try{
                            return eval("(data."+bindName+")")
                        }catch (e) {
                            console.error("[ SURFACE ] 变量解析失败："+bindName, e)
                        }
                    }
                    _bind.__s_computed_exec = !0
                    obj[attrName] = _bind
                    global.__s_computed = true
                    delete obj[i]
                    continue;
                }
            }
            if(typeof obj[i] === 'object'){
                handler(obj[i], global === null ? obj[i] : global)
            }
        }
    }
}(data))
JS, ["data"]);
    }

    /**
     * setup最后执行
     * 解析数据实现双休绑定
     *
     * @return Functions
     */
    private function setupAfter() :Functions
    {
        return Functions::create(<<<JS
            const handler = function(obj) {
                if (typeof obj === 'object') {
                    for (let i in obj) {
                        if (typeof obj[i] === 'function' && obj[i].__s_computed_exec === true) {
                            obj[i] = obj[i]()
                        } else if(typeof obj[i] === 'object'){
                            handler(obj[i])
                        }
                    }
                }
                return obj
            }
            for (let k in data) {
                if (typeof data[k] === 'object' && data[k].__s_computed === true) {
                    let original = Surface.cloneDeep(data[k])
                    data[k] = Vue.computed(() => {
                        return handler(Surface.cloneDeep(original))
                    })
                }
            }
        
JS, ["data"]);

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

        array_unshift($this->setups, $this->setupBefore());

        $this->setups[] = $this->setupAfter();
    }

    protected function beforeView() :void
    {
        $this->importDependent();
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

        $setups = [];
        foreach ($this->setups as $setup)
        {
            $setups[] = $setup->format();
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
     * 生成页面
     *
     * @return string
     */
    public function view(): string
    {
        $this->beforeView();

        ob_start();
        include dirname(__FILE__).DIRECTORY_SEPARATOR.'template'.DIRECTORY_SEPARATOR.'view.php';
        return ob_get_clean();
    }

}



