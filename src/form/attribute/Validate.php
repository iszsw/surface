<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\form\attribute;

use surface\AttrBase;

class Validate extends AttrBase
{

    protected function attr():array
    {
        return [
            "required" => true,
            "message" => null,
            "pattern" => null, // 正则表达式校验
            "trigger" => null,
            "type" => 'string', //string:number:boolean:method:regexp:integer:float:array:object:enum:date:url:hex:email:
            "min" => null,
            "max" => null,
            "len" => null,
            "enum" => null, // 枚举类型
            "whitespace" => null, // true时，空格是否会被视为错误
        ];
    }

}