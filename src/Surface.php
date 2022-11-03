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
     * @var array<Document>
     */
    private array $documents = [];

    private string $globalSize = 'default';

    private bool $importDependent = false;

    public function __construct()
    {
        $this->init();
    }

    /**
     * 添加HTML模板
     *
     * @return $this
     */
    public function append(Document $document, bool $unshift = false): self
    {
        $document->trigger(Document::EVENT_CREATE, [$this]);
        if ($unshift) {
            array_unshift($this->documents, $document);
        }else{
            $this->documents[] = $document;
        }
        return $this;
    }

    protected function init()
    {
        $this->register(Functions::create('app.use(ElementPlus, {locale: (typeof ElementPlusLocaleZhCn === "undefined") ?null:ElementPlusLocaleZhCn, size: "'.$this->globalSize.'"});app.use(Surface);', ['app']));
    }

    /**
     * 设置全局组件尺寸
     *
     * @param string $size
     *
     * @return $this
     */
    public function setSize(string $size = ''):self
    {
        $this->globalSize = $size;
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

    private function toJson(array $array):string
    {
        return json_encode($array, JSON_UNESCAPED_UNICODE);
    }

    private function importDependent(){
        if (!$this->importDependent) {
            $this->addScript(
                [
                    '<script src="//unpkg.com/vue@3"></script>',
                    '<script src="//unpkg.com/element-plus"></script>',
                    '<script src="//unpkg.com/element-plus/dist/locale/zh-cn"></script>',
                    '<script src="//unpkg.com/surface-plus"></script>',
                ], true
            );

            $this->addStyle(
                [
                    '<link href="//unpkg.com/element-plus/dist/index.css" rel="stylesheet">',
                    '<link href="//unpkg.com/surface-plus/dist/index.css" rel="stylesheet">',
                ], true
            );

            $this->importDependent = true;
        }
    }

    /**
     * 生成代码
     * 不包括样式和依赖的js
     *
     * @return string
     */
    public function display(): string
    {
        $documentNode = [];
        $documentData = [];
        foreach ($this->documents as $document)
        {
            $document->trigger(Document::EVENT_VIEW, [$this]);
            $documentNode[] = $document->getNode();
            $documentData = array_merge($documentData, $document->getBind());
        }

        $registers = [];
        foreach ($this->registers as $register)
        {
            $registers[] = $register->format();
        }

        $setups = [];
        $setupData = $this->setups;
        array_unshift($setupData, $this->dataInit());
        foreach ($setupData as $setup)
        {
            $setups[] = $setup->format();
        }

        $id = $this->id();
        $setups = $this->toJson($setups);
        $registers = $this->toJson($registers);
        $documentData = $this->toJson($documentData);
        $documentNode = implode('', $documentNode);

        ob_start();
        include dirname(__FILE__).DIRECTORY_SEPARATOR.'template'.DIRECTORY_SEPARATOR.'display.php';

        return ob_get_clean();
    }

    /**
     * setup数据初始化 最先执行
     *
     * ref:field
     * reactive:field
     *
     * @return Functions
     */
    private function dataInit() :Functions
    {
        return Functions::create(<<<JS
for(let i in data) {
    let split = i.split(":", 2)
    let func = split[0].toLocaleString()
    if (split.length > 1 && ['ref', 'reactive'].indexOf(func) > -1) {
        data[split[1]] = Vue[func](data[i])
        delete data[i]
    }
}
JS, ["data"]);
    }

    /**
     * 生成页面
     *
     * @return string
     */
    public function view(): string
    {
        $this->importDependent();
        ob_start();
        include dirname(__FILE__).DIRECTORY_SEPARATOR.'template'.DIRECTORY_SEPARATOR.'view.php';
        return ob_get_clean();
    }

}



