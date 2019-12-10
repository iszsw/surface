<?php
/*
 * Author: zsw zswemail@qq.com
 */

namespace surface\table\attribute;

use surface\AttrBase;

/**
 * 只处理复杂表头信息时用到。需要配置 columns 一起使用
 * Class TitleRows
 *
 * @package surface\table\attribute
 * Author: zsw zswemail@qq.com
 */
class Rows extends AttrBase
{
    protected function attr(): array
    {
        return [
            "fields"     => [], // array [*]
            "title"      => "", // string [*] 列头显示文字，columns 中不用配置
            "titleAlign" => "", // string [*] 表头列内容对齐方式，columns 中不用配置
            "rowspan"    => "", // number [*] 合并行的数目
            "colspan"    => "", // number [*] 合并列的数目
            "orderBy"    => "", // string [*] 排序规则，columns 中不用配置 asc/desc
        ];
    }

}