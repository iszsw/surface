<?php
/*
 * Author: zsw zswemail@qq.com
 */

namespace surface\helper\tp;

/**
 * 生成器接口
 *
 * Interface FormInterface
 * Author: zsw zswemail@qq.com
 */
interface FormInterface
{

    /**
     * 默认配置
     *
     * @return array
     * Author: zsw zswemail@qq.com
     */
    public function defaults():array;

    /**
     * 列信息
     *
     * @return array
     * Author: zsw zswemail@qq.com
     */
    public function column():array;

    /**
     * 数据提交接收方法
     *
     * @return array ['code' => 1, 'data' => [], 'msg' => '']; code = 0成功|1失败
     * Author: zsw zswemail@qq.com
     */
    public function save() ;

}