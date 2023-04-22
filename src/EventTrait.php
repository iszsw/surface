<?php

namespace surface;


trait EventTrait
{

    /**
     * @var array
     */
    protected array $listener = [];

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
        return isset($this->listener[$event]);
    }


    /**
     * 触发事件
     *
     * @access public
     *
     * @param string $event  事件名称
     * @param mixed  $params 传入参数
     */
    public function trigger(string $event, $params = null): void
    {
        if ($this->hasListener($event)) {
            foreach ($this->listener[$event] as $k => $listener)
            {
                $handler = $listener['handler'];

                $once = $listener['once'];

                if ($once)
                {
                    unset($this->listener[$event][$k]);
                }

                $this->dispatch($handler, $params);
            }
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

            return method_exists($class, 'run') ? $class->run() : $class;
        }

        return $server;
    }

}


