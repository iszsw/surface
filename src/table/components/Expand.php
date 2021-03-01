<?php

namespace surface\table\components;

/**
 * 可展开列
 *
 * Class Expand
 *
 * @package surface\table\components
 * Author: zsw zswemail@qq.com
 */
class Expand extends Column
{

    protected function init()
    {
        $this->props(['type'  => 'expand', 'width' => '55']);
    }

}


