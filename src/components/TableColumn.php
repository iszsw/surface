<?php

namespace surface\components;

use surface\Component;

/**
 * table列配置
 *
 * 部分参数说明
 *
 * @method $this label(string $label)    名称;
 * @method $this prop(string  $prop)     "字段名";
 * @method $this sortable(bool $sortable) true;  排序
 * @method $this filters(array $filters)  [["text" => "a", "value" => "aa"], ["text" => "b", "value" => "bb"]]; 表头过滤 【必须】添加column-key参数
 * @method $this children(array|string|Component $children) []; //当前列的子组建 子组建中任何参数值都可以根据当前行的数据动态绑定 4种绑定格式
 *    1、(new Component(['el' => 'div', ':children' => ''])) // 绑定当前行当前列数据到children
 *    2、(new Component(['el' => 'div', ':children' => '年龄：{age}'])) // 当前列的age字段替换到文本中
 *    3、(new Component([':children' => Functions::create("return '虚岁：' + row[field]", ["field", "row", "prop"])])) // 自定义处理函数
 *    4、(new Component(['el' => 'span', 'props' => [':innerHTML' => "<b>{name}</b>"]])) // html渲染需要绑定到innerHTML
 *
 * @see https://element-plus.org/zh-CN/component/table.html#table-column-%E5%B1%9E%E6%80%A7
 */
class TableColumn extends Component
{

    /**
     * table列子组件中自定义一个字段名不使用当前列的字段名
     */
    const MODEL_PROP = '__model_prop';


}

