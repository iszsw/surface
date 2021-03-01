<?php
/*
 * Author: zsw zswemail@qq.com
 */

namespace surface\helper;

use surface\Component;
use surface\table\components\Header;
use surface\table\components\Pagination;

/**
 * Interface TableInterface
 */
interface TableInterface
{

    /**
     * 顶部按钮配置
     *
     * @return Header|null
     */
    public function header(): ?Header;

    /**
     * 默认配置
     *
     * @return array
     * Author: zsw zswemail@qq.com
     */
    public function options():array;

    /**
     * 列信息
     *
     * @return array<Component>
     */
    public function columns():array;

    /**
     * 分页
     *
     * @return Pagination|null
     */
    public function pagination(): ?Pagination;

    /**
     * 结果
     *
     * @param array $where
     * @param string $order
     * @param int $page
     * @param int $limit
     * @return array 返回 ['count'=>总数量, 'list'=> 当前页列表 ]
     */
    public function data($where = [], $order = '', $page = 1, $limit = 15):array;

}
