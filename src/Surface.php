<?php

namespace surface;

use surface\exception\SurfaceException;

/**
 *
 * surface 公共类
 *
 * Class Surface
 *
 * @package surface
 * Author: zsw zswemail@qq.com
 */
abstract class Surface
{
    use ModelTrait;
    use ColumnTrait;

    /**
     * 唯一标识
     *
     * @var string
     */
    protected $id;

    protected $script = [];

    protected $style = [];

    /**
     * 组件
     *
     * @var array
     */
    protected static $components = [];

    /**
     * 组件配置
     *
     * @var Config
     */
    protected $config = [];

    /**
     * 延迟执行 传入闭包时延迟执行
     * 只能通过继承覆盖
     * 如果需要立即执行设置false
     *
     * @var bool
     */
    protected $delay = true;

    /**
     * 待处理闭包
     *
     * @var \Closure|null
     */
    protected $closure;

    /**
     * 搜索表单
     *
     * @var boolean
     */
    protected $search = false;

    public function __construct($closure = null, array $config = [])
    {
        $this->config = $config;

        $this->init();

        if ($closure instanceof \Closure)
        {
            $this->closure = $closure;
            $this->delay || $this->execute();
        }
    }

    /**
     * 立即执行
     *
     * @return $this
     * @throws SurfaceException
     */
    protected function execute()
    {
        if ( ! is_null($this->closure))
        {
            static::dispose($this->closure, [$this]);
            $this->closure = null;
        }

        return $this;
    }

    public static function __callStatic($name, $arguments)
    {
        return static::make($name, $arguments);
    }

    public function __call($name, $arguments)
    {
        return $this->make($name, $arguments);
    }

    public static function make($name, $arguments)
    {
        $component = static::$components[$name] ?? null;

        if ( ! $component)
        {
            throw new SurfaceException("Component:{$name}  is not founded!");
        }

        return static::dispose($component, $arguments);
    }

    public static function getServers()
    {
        return static::$components;
    }

    protected static function dispose($server, $ages = [])
    {
        try
        {
            if ($server instanceof \Closure || is_array($server))
            {
                return call_user_func_array($server, $ages);
            } elseif (class_exists($server))
            {
                return (new \ReflectionClass($server))->newInstanceArgs($ages);
            } else
            {
                return $server;
            }
        } catch (\Exception $e)
        {
            throw new SurfaceException($e->getMessage(), $e->getCode());
        }
    }

    public static function bind($name, $call)
    {
        static::$components[$name] = $call;
    }

    public function addScript($script)
    {
        if (is_array($script))
        {
            foreach ($script as $v)
            {
                $this->addResources($v);
            }
        } else
        {
            $this->addResources($script);
        }

        return $this;
    }

    public function addStyle($style)
    {
        if (is_array($style))
        {
            foreach ($style as $v)
            {
                $this->addResources($v, 'style');
            }
        } else
        {
            $this->addResources($style, 'style');
        }

        return $this;
    }

    private function addResources($resource, $type = 'script')
    {
        if ($type === 'script')
        {
            if ( ! in_array($resource, $this->script))
            {
                $this->script[] = $resource;
            }
        } else
        {
            if ( ! in_array($resource, $this->style))
            {
                $this->style[] = $resource;
            }
        }

        return $this;
    }

    public function getId()
    {
        if (empty($this->id))
        {
            $this->id = uniqid('z');
        }

        return $this->id;
    }

    public function getStyle()
    {
        return $this->style;
    }

    public function getScript()
    {
        return $this->script;
    }

    /**
     * 搜索字段
     *
     * @param bool|null $search
     *
     * @return $this|bool
     */
    public function search( ?bool $search = null)
    {
        if (is_null($search)) {return $this->search;}

        $this->search = $search;
        return $this;
    }

    public function view(): string
    {
        return $this->execute()->page();
    }

    protected function init()
    {
        $this->model(new Component($this->config));

        $name = strtolower(basename(static::class));

        $this->addScript(
            [
                '<script src="//cdn.staticfile.org/vue/2.6.12/vue.js"></script>',
                '<script src="//cdn.staticfile.org/axios/0.19.0-beta.1/axios.min.js"></script>',
                '<script src="//cdn.staticfile.org/element-ui/2.14.1/index.min.js"></script>',
                '<script src="//cdn.jsdelivr.net/gh/iszsw/surface-src/'.$name.'.js"></script>',
            ]
        );
    }

    protected $theme = [
            '<link href="//cdn.jsdelivr.net/gh/iszsw/surface-src/index.css" rel="stylesheet">',
        ];

    /**
     * 自定义主题设置
     *
     * @param string|array $theme 主题样式
     * @param bool         $cover 覆盖
     *
     * @return $this
     */
    public function theme($theme, $cover = true): self
    {
        if ($cover)
        {
            $this->theme = [];
        }
        array_map(
            function ($t)
            {
                array_push($this->theme, $t);
            }, (array)$theme
        );

        return $this;
    }

    /**
     * 获取页面
     *
     * @return mixed
     * Author: zsw zswemail@qq.com
     */
    abstract protected function page(): string;

}
