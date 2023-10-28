<?php

namespace surface;


trait EventTrait
{

    /**
     * 实例事件
     * @var array
     */
    protected array $listener = [];

    /**
     * 全局事件 优先实例事件触发
     * @var array
     */
    protected static array $globalListener = [];

    /**
     * 注册事件监听
     *
     * @access public
     *
     * @param string $event   事件名称
     * @param mixed  $handler 监听操作（或者类名）
     * @param bool   $once    只执行一次
     * @param bool   $first   是否优先执行
     *
     * @return $this
     */
    public function listen(string $event, $handler, bool $once = true, bool $first = false): self
    {
        $listener = [
            'handler' => $handler,
            'once'    => $once,
        ];
        if ($first && isset($this->listener[$event]))
        {
            array_unshift($this->listener[$event], $listener);
        } else
        {
            $this->listener[$event][] = $listener;
        }

        return $this;
    }

    /**
     * 注册全局事件
     *
     * @param string $event   事件名称
     * @param mixed  $handler 监听操作（或者类名）
     * @param bool   $first   是否优先执行
     * @return void
     */
    public static function globalListen(string $event, $handler, bool $first = false): void
    {
        if (!isset(self::$globalListener[$event])) {
            self::$globalListener[$event] = [];
        }

        $listener = [
            'handler' => $handler,
            'once'    => false,
        ];

        if ($first && isset(self::$globalListener[$event][static::class]))
        {
            array_unshift(self::$globalListener[$event][static::class], $listener);
        } else
        {
            self::$globalListener[$event][static::class][] = $listener;
        }

    }

    /**
     * 是否存在事件监听
     *
     * @access public
     *
     * @param string $event 事件名称
     *
     * @return bool
     */
    public function hasListener(string $event): bool
    {
        return isset($this->listener[$event]) || isset(self::$globalListener[$event]);
    }

    /**
     * 触发事件
     *
     * @access public
     *
     * @param string $event  事件名称
     * @param array  $params 传入参数
     */
    public function trigger(string $event, array $params = []): void
    {
        if (!($params[0] ?? null) instanceof static) {
            $params[0] = $this;
        }

        if ($this->hasListener($event)) {
            if (isset(self::$globalListener[$event])) {
                foreach (self::$globalListener[$event] as $static => &$events) {
                    if ($this instanceof $static) {
                        $this->triggerEvent($events, $params);
                    }
                }
                unset($events);
            }

            isset($this->listener[$event]) && ($events = &$this->listener[$event]) && $this->triggerEvent($events, $params);
            unset($events);
        }
    }

    private function triggerEvent(array &$events, array $params = []): void
    {
        foreach ($events as $k => $listener)
        {
            $handler = $listener['handler'];
            $once = $listener['once'];
            if ($once) unset($events[$k]);
            $this->dispatch($handler, $params);
        }
    }

    private function dispatch($server, $params = [])
    {
        if ($server instanceof \Closure || is_array($server))
        {
            return call_user_func_array($server, $params);
        } elseif (class_exists($server))
        {
            $class = (new \ReflectionClass($server))->newInstanceArgs($params);
            return method_exists($class, 'handle') ? $class->handle() : $class;
        }

        return $server;
    }

}


