<?php

namespace surface\helper;

/**
 *
 * 助手基础类
 *
 * Class FormAbstract
 *
 * @package surface\helper
 * Author: zsw iszsw@qq.com
 */
abstract class Base
{

    /**
     * 错误信息
     *
     * @var string
     */
    protected $error = '';

    /**
     * 获取错误
     *
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

}
