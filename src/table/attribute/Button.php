<?php
/*
 * Author: zsw zswemail@qq.com
 */

namespace surface\table\attribute;

use surface\AttrBase;

/**
 * @package surface\table\attribute
 * Author: zsw zswemail@qq.com
 */
class Button extends AttrBase
{
    protected function attr(): array
    {
        return [
            "type"   => '',
            "title"  => "",         // string 列头显示文字，columns 中不用配置
            "params" => [
                'icon' => '',
                'text' => '',
                'title' => '',
                'url' => '',            // string 提交的地址
                'method' => 'POST',     // string 提交的方法
                'refresh' => false,     // string 提交后刷新页面
                'params' => [],         // string 需要提交的参数 从列中获取
            ],                          // array sweet-alert参数值
            "faClass"    => "",         // string fa图标样式
        ];
    }

}