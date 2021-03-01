<?php
namespace surface\table\traits;


use surface\Component;

/**
 * 分页
 *
 * Class Input
 *
 * @package surface\form\components
 * Author: zsw zswemail@qq.com
 */
trait Header
{

    /**
     * @var Component
     */
    protected $header;

    /**
     * 注册分页组件
     *
     * @param Component $header
     */
    public function header( Component $header )
    {
        $this->header = $header;
    }

    public function getHeader()
    {
        return $this->header;
    }


}
