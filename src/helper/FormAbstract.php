<?php

namespace surface\helper;

/**
 *
 * Form抽象类 使用助手[必须]继承该类
 *
 * Class FormAbstract
 *
 * @package surface\helper
 * Author: zsw iszsw@qq.com
 */
abstract class FormAbstract extends Base
{

    /**
     * 搜索条件
     *
     * 只在search中生效
     *
     * 搜索参数没有在rules中配置 表示 '='
     *
     */
    public function rules():array {
        return [];
    }

    /**
     * 默认配置
     *
     * @return array
     */
    public function options():array {
        return [
            'async'    => [
                'url' => '',
            ]
        ];
    }

    /**
     * 列信息
     *
     * @return array
     */
    abstract public function columns():array;

    /**
     * 数据提交接收方法
     *
     * @return Bool
     */
    public function save():bool {
        return true;
    }

}
