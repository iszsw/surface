<?php

namespace surface\table\components;

use surface\Component;

/**
 * 可编辑组件
 * Class Editable
 *
 * @package surface\table\components
 * Author: zsw zswemail@qq.com
 */
abstract class Editable extends Component
{

    /**
     * 组件名
     *
     * @var string
     */
    protected $name = 's-editable';

    /**
     * 可编辑类型
     *
     * @var string
     */
    protected $type = 'text';


    public function __construct(array $config = [])
    {
        parent::__construct(array_merge($config, [
            'el' => $this->name,
            'props' => ['type' => $this->type]
        ]));
    }


}


