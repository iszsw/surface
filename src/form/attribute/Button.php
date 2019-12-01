<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\form\attribute;

use surface\AttrBase;
use surface\form\Type;

class Button extends AttrBase
{
    protected function attr():array
    {
        return [
            "type"=> 'primary',
            "size"=> "medium",
            "plain"=> false,
            "round"=> false,
            "circle"=> false,
            "loading"=> false,
            "disabled"=> false,
            "icon"=> '',
            "width"=> null,
            "autofocus"=> false,
            "nativeType"=> "button",
            "innerText"=> "",
            "show"=> true,
            "col"=> [],
            "click"=> null,
        ];
    }

}