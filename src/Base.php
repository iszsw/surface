<?php
/*
 * Author: zsw zswemail@qq.com
 */

namespace surface;

abstract class Base
{

    /**
     * 唯一标识
     *
     * @var string
     */
    protected $id;

    protected static $servers = [];

    /**
     * @var array
     */
    private $script = [];

    private $style = [];

    /**
     * 延迟执行
     * 传入闭包时 可以延迟执行
     * @var bool
     */
    private $delay = false;

    /**
     * 静态资源地址
     *
     * 提供免费的CDN
     * @var string
     */
    private $staticDomain = '//s.zsw.ink';

    /**
     * 待处理闭包
     *
     * @var \Closure|null
     */
    private $closure;

    public function __construct($closure = null)
    {
        if ($closure instanceof \Closure) {
            $this->closure = $closure;
            $this->delay && $this->resolveClosure();
        }

        $this->init();
    }

    protected function init(){}

    public function delay()
    {
        $this->delay = true;
        return $this;
    }

    protected function resolveClosure()
    {
        if (!is_null($this->closure)) {
            static::dispose($this->closure, [$this]);
            $this->closure = null;
        }
        return $this;
    }

    public static function make($name, $arguments)
    {
        $server = static::$servers[$name] ?? null;

        if (!$server) {return null;}

        return static::dispose($server, $arguments);
    }

    public static function getServers()
    {
        return static::$servers;
    }

    protected static function dispose($server, $ages = [])
    {
        if ($server instanceof \Closure || is_array($server)) {
            return call_user_func_array($server, $ages);
        } elseif (class_exists($server)) {
            return (new \ReflectionClass($server))->newInstanceArgs($ages);
        } else {
            return $server;
        }
    }

    public static function bind($name, $call)
    {
        static::$servers[$name] = $call;
    }

    public static function __callStatic($name, $arguments)
    {
        return static::make($name, $arguments);
    }

    public function addScript($script)
    {
        if (is_array($script)) {
            foreach ($script as $v) {
                $this->addResources($v);
            }
        } else {
            $this->addResources($script);
        }

        return $this;
    }

    public function addStyle($style)
    {
        if (is_array($style)) {
            foreach ($style as $v) {
                $this->addResources($v, 'style');
            }
        } else {
            $this->addResources($style, 'style');
        }

        return $this;
    }

    private function addResources($resource, $type = 'script')
    {
        if ($type === 'script') {
            if (!in_array($resource, $this->script))
                $this->script[] = $resource;
        } else {
            if (!in_array($resource, $this->style))
                $this->style[] = $resource;
        }
        return $this;
    }


    public function getId()
    {
        if (empty($this->id)) {
            $this->id = "z" . uniqid();
        }

        return $this->id;
    }

    public function getConfig($key = '')
    {
        if ($key == '') {
            return $this->config;
        } else {
            return $this->config[$key] ?? '';
        }
    }

    public function getStyle()
    {
        return $this->style;
    }

    public function getScript()
    {
        return $this->script;
    }

    public function setStaticDomain($domain)
    {
        $this->staticDomain = $domain;
        return $this;
    }

    public function getStaticDomain()
    {
        return $this->staticDomain;
    }

    public function __toString()
    {
        try {
            return $this->view();
        }catch (\Throwable $t) {
            exit('['.$t->getFile() . ':' . $t->getLine().']' . $t->getMessage());
        }
    }

    public function view():string
    {
        $this->resolveClosure();
        return $this->page();
    }

    /**
     * 获取页面
     * @return mixed
     * Author: zsw zswemail@qq.com
     */
    abstract protected function page():string ;

}