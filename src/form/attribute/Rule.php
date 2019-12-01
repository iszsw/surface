<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\form\attribute;

use surface\AttrBase;

class Rule extends AttrBase
{
    protected function attr():array
    {
        return [
            "type" => null,
            "title" => '',
            "field" => null,
            "value" => '',
            "col" => [],
            "props" => [],
            "children" => [],
            "options" => [], //可选参数
            "validate" => [],
        ];
    }

}