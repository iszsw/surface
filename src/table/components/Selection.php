<?php

namespace surface\table\components;

use surface\Config;

/**
 * Table 选择框
 *
 * Class Selection
 *
 * @package surface\table\components
 * Author: zsw zswemail@qq.com
 */
class Selection extends Column
{

    /**
     * Selection constructor.
     * * @param string $prop 一般为主键值  选中状态时候以该值作为参数传递
     */
    public function __construct(string $prop = 'id')
    {
        $this->config = new Config(
            [
                'props' => [
                    'prop' => $prop,
                    'type' => 'selection',
                    'width' => '55',
                ]
            ]
        );
    }

}


