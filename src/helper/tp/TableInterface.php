<?php
/*
 * Author: zsw zswemail@qq.com
 */

namespace surface\helper\tp;

/**
 * 生成器接口
 *
 * Interface TableInterface
 * Author: zsw zswemail@qq.com
 */
interface TableInterface
{

    /**
     * 返回搜索参数
     *
     * @return array 返回''不搜索
     */
    public function rules(): array;

    /**
     * 默认配置
     *
     * @return array
     */
    public function defaults():array;

    /**
     * 列信息
     *
     * @return array
     */
    public function column():array;

    /**
     * 搜索条件会传入到search方法中
     *
     * @param array $where
     * @param string $order
     * @param int $page
     * @param int $row_num
     * @return array 返回['count'=>总数量, 'list'=>当前页列表]
     */
    public function search($where = [], $order = '', $page = 1, $row_num = 15):array;

}