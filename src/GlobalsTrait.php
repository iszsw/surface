<?php

namespace surface;

/**
 * Table Form 模型
 *
 * @package surface\globals\traits
 * Author: zsw zswemail@qq.com
 */
trait GlobalsTrait
{

    /**
     * @var Component
     */
    protected $globals;

    /**
     * @param Component $globals
     */
    public function globals(Component $globals)
    {
        $this->globals = $globals;
    }

    /**
     * @param        $key
     * @param string $val
     *
     * @return $this
     */
    public function options($key, $val = ''): self
    {
        if (is_array($key)) {
            foreach ($key as $k => $v) {
                $this->options($k, $v);
            }
        }else{
            $this->globals->$key($val);
        }

        return $this;
    }

    /**
     * @return Component
     */
    public function getGlobals()
    {
        return $this->globals;
    }


}
