<?php
/*
 * Author: zsw zswemail@qq.com
 */

namespace surface\table\attribute;

use surface\AttrBase;

class Column extends AttrBase
{
    protected function attr(): array
    {
        return [
            "type"               => 'text', // string 列表类型 text/textEdit/switchEdit/selectEdit
            "field"              => null, // string 对应列的字段
            "title"              => null, // string 列头显示文字
            "sort"               => null, // string 允许排序
            "options"            => null, // array 选项
            "class"              => null, // string class拓展
            "width"              => null, // number 每一列的宽度，列设置横向自适应is-horizontal-resize:true时，必须要设置值
            "edit_url"           => null, // string 提交地址 type为edit类型有效
            "align"              => 'center', // 位置
            "editRefreshAfter"   => null, // bool 提交成功之后获取新数据 type为edit类型有效
        ];
    }

}