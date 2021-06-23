<?php
namespace surface\table\traits;

use surface\Component;

/**
 * 分页
 *
 * Class Input
 * @package surface\form\components
 * Author: zsw zswemail@qq.com
 */
trait Pagination
{

    /**
     * @var Component
     */
    protected $pagination;

    /**
     * 注册分页组件
     *
     * @param Component $component
     */
    public function pagination( Component $component )
    {
        $this->pagination = $component;
    }

    public function getPagination()
    {
        return $this->pagination;
    }


}
