<?php

namespace surface;

/**
 * js函数
 *
 * @package surface
 */
class Functions implements IFormat
{

    private string $fn;
    private ?array $params;

    const PREFIX = 'FN:';

    /**
     * Func constructor.
     *
     * @param string $fn     方法体 支持写入到<script>...</script>标签中 方便IDE代码提示
     * @param array  $params 注入的参数
     *
     */
    public function __construct(string $fn, array $params = [])
    {
        $fn = preg_replace("/<\/?script.*?>/", "", $fn);
        $fn = trim($fn, " \r\n");
        $pref = 'function(';
        if (strpos($fn, $pref) === 0)
        {
            $reCount = 1;
            $fn = str_replace($pref, '(', $fn, $reCount);
            $this->params = null;
        } else
        {
            $this->params = $params;
        }
        $this->fn = $fn;
    }

    /**
     * 创建 Function
     *
     * 1、('function(app){app.component()}')
     * 2、('app.component(...)',[app])
     *
     * @param string $fn
     * @param array  $params 自定义回调参数名称
     *
     * @return static
     * Author: zsw zswemail@qq.com
     */
    public static function create(string $fn, array $params = []): self
    {
        return new static($fn, $params);
    }

    /**
     * 格式化 返回js格式方法
     *
     * @return string
     */
    public function format()
    {
        return self::PREFIX.($this->params ? "(".implode(',', $this->params)."){{$this->fn}}" : $this->fn);
    }

}

