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
    protected $script = [];

    protected $style = [];

    public function __construct($closure = null)
    {
        if (!empty($closure) && $closure instanceof \Closure) {
            call_user_func($closure, $this);
        }
    }

    public static function make($name, $arguments)
    {
        $server = static::$servers[$name] ?? null;
        if (!$server) {
            return null;
        }

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

    public function bind($name, $call)
    {
        self::$servers[$name] = $call;
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

    public function __toString()
    {
        return $this->view();
    }

    abstract public function view();

}