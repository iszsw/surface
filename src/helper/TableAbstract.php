<?php

namespace surface\helper;

use surface\Component;

/**
 * Table抽象类 使用助手[必须]继承该类
 *
 * Class TableAbstract
 *
 * @package surface\helper
 * Author: zsw iszsw@qq.com
 */
abstract class TableAbstract extends Base
{

    /**
     * 顶部按钮配置
     *
     * @return Component|null
     */
    public function header(): ?Component{
        return null;
    }

    /**
     * 默认配置
     *
     * @return array
     * Author: zsw iszsw@qq.com
     */
    public function options():array{
        return [];
    }

    /**
     * 列信息
     *
     * @return array<Component>
     */
    abstract public function columns():array;

    /**
     * 分页
     *
     * @return null|Component
     */
    public function pagination(): ?Component{
        return (new Component())->props(
            [
                'async' => [
                    'url' => '',
                ],
            ]
        );
    }

    /**
     * 返回数据
     *
     * @param array $where
     * @param string $order
     * @param int $page
     * @param int $limit
     * @return array 返回 ['count'=>总数量, 'list'=> 当前页列表 ]
     */
    public function data($where = [], $order = '', $page = 1, $limit = 15):array{
        return [];
    }

    /**
     * 搜索
     *
     * @return FormAbstract|null
     */
    function search(): ?FormAbstract {
        return null;
    }

}
