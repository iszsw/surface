<?php

namespace surface\helper;

/**
 *
 * Table抽象类 使用助手[必须]继承该类
 *
 * Class FormAbstract
 *
 * @package surface\helper
 * Author: zsw zswemail@qq.com
 */
abstract class FormAbstract extends Base
{

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
