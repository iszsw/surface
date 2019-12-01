<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\form\attribute;

use surface\AttrBase;

class Col extends AttrBase
{
    protected function attr():array
    {
        return [
            "span" => null,       // int [*] 栅格的占位格数，可选值为0~24的整数，为 0 时，相当于display:none
            "labelWidth" => null, // int [*] 设置表单域 label 的宽度
            "order" => null,     // int [*] 栅格的顺序，在flex布局模式下有效
            "offset" => null,     // int [*] 栅格的顺序，在flex布局模式下有效
            "push" => null,
            "pull" => null,
            "class-name" => null,
            "xs" => null,
            "sm" => null,
            "md" => null,
            "lg" => null,
        ];
    }

}