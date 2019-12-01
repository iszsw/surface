<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\form\attribute;

use surface\AttrBase;

class Row extends AttrBase
{
    protected function attr():array
    {
        return [
            "gutter"=> 0, //int [*] 行内标签之间的间距px
            "type"=> null,
            "align"=> null,
            "justify"=> null,
            "tag"=> 'div'
        ];
    }

}