<?php
namespace surface\table\traits;

use surface\table\components\Pagination as PaginationComponent;

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
     * @var PaginationComponent
     */
    protected $pagination;

    /**
     * 注册分页组件
     *
     * @param PaginationComponent $pagination
     */
    public function pagination( PaginationComponent $pagination )
    {
        $this->pagination = $pagination;
    }

    public function getPagination()
    {
        return $this->pagination;
    }


}
