<?php
/*
 * Author: zsw zswemail@qq.com
 */

namespace surface\helper;

/**
 * Interface FormInterface
 */
interface FormInterface
{

    /**
     * 默认配置
     *
     * @return array
     */
    public function options():array;

    /**
     * 列信息
     *
     * @return array
     */
    public function columns():array;

    /**
     * 数据提交接收方法
     *
     * @return string|Bool 成功提示|true|false
     */
    public function save() ;

}
