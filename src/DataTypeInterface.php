<?php
/*
 * Author: zsw zswemail@qq.com
 */

namespace surface;
use surface\form\Form;
use surface\table\Table;


/**
 * 格式化数据
 *
 * Interface HtmlInterface
 *
 * @package Surface
 * Author: zsw zswemail@qq.com
 */
interface DataTypeInterface
{

    /**
     * @return mixed
     * Author: zsw zswemail@qq.com
     */
    public function getData();

    /**
     * 数据创建时触发
     *
     * @param $self Form|Table 当前实例
     * Author: zsw zswemail@qq.com
     */
    public function init($self):void ;

}

