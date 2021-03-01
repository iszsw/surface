<?php
/*
 * Author: zsw zswemail@qq.com
 */

namespace surface\helper;

/**
 * 助手类
 * Class Helper
 * Author: zsw
 */
class Helper
{

    public static function isPost(): bool
    {
        return isset($_SERVER['REQUEST_METHOD']) && strtoupper($_SERVER['REQUEST_METHOD']) == 'POST';
    }

    public static function isGet(): bool
    {
        return isset($_SERVER['REQUEST_METHOD']) && strtoupper($_SERVER['REQUEST_METHOD']) == 'GET';
    }

    public static function isAjax(): bool
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtoupper($_SERVER['HTTP_X_REQUESTED_WITH']) == 'XMLHTTPREQUEST';
    }

    /**
     *
     * 去空值&类型转换
     *
     * @param $array array
     *
     * @return string
     * Author: zsw
     */
    public static function filterEmpty($array)
    {
        if (empty($array))
        {
            return '';
        }
        foreach ($array as $k => $v)
        {
            if (null === $v || (is_array($v) && count($v) === 0))
            {
                unset($array[$k]);
            } elseif (is_array($v) || $v instanceof \IteratorAggregate)
            {
                $array[$k] = static::filterEmpty($v);
            } elseif (is_numeric($v) && $v < PHP_INT_MAX)
            {
                $array[$k] = (float)$v;
            } elseif (is_string($v) && in_array(strtolower($v), ['false', "true"]))
            {
                $array[$k] = (strtolower($v) == 'true');
            }
        }

        return $array;
    }


}
