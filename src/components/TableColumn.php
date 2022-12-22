<?php

namespace surface\components;

use surface\Component;

/**
 * table列配置
 *
 * 部分参数说明
 *
 * @method self label(string $label)    名称;
 * @method self prop(string  $prop)     "字段名";
 * @method self sortable(bool $sortable) true;  排序
 * @method self filters(array $filters)  [["text" => "a", "value" => "aa"], ["text" => "b", "value" => "bb"]]; 表头过滤 【必须】添加column-key参数
 * @method self children(array $children) []; //当前列的子组建 子组建中任何参数值都可以根据当前行的数据动态绑定 4种绑定格式
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
     * table中子组件特有属性
     * 只支持绑定到第一级子组件
     *
     * 表格数据修改事件 onChange事件
     *
     * $component->props([\surface\components\TableColumn::EVENT_CHANGE => $event]);
     *
     * @param array $event
     *      [
     *      'before' => Functions::class | [prop, data], // 前置方法 返回 false 阻止提交
     *      'after' => Functions::class  | [prop：字段, data：本列数据, res：异步修改成功响应], // 修改成功触发后置方法,请求异常时after返回true不提示错误信息
     *      'request' => ["url" => 'api/update'], // 提交时request配置
     *      ]
     */
    const EVENT_CHANGE = '__ev_change';


    /**
     * table子组件中自定义一个字段名不使用当前列的字段名
     */
    const MODEL_PROP = '__model_prop';


}
