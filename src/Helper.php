<?php
/*
 * Author: zsw zswemail@qq.com
 */

namespace surface;

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

    public static function isAjax(): bool
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtoupper($_SERVER['HTTP_X_REQUESTED_WITH']) == 'XMLHTTPREQUEST';
    }

    /**
     * 驼峰转下划线
     *
     * @param        $str
     * @param string $separator
     *
     * @return string
     */
    public static function snake($str,$separator='_')
    {
        return strtolower(preg_replace('/([a-z])([A-Z])/', "$1" . $separator . "$2", $str));
    }

    /**
     * 下划线转驼峰(首字母小写)
     *
     * @param        $str
     * @param string $separator
     *
     * @return string
     */
    public static function camel($str,$separator='_')
    {
        $str = $separator. str_replace($separator, " ", strtolower($str));
        return ltrim(str_replace(" ", "", ucwords($str)), $separator );
    }

}
