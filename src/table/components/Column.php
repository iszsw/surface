<?php

namespace surface\table\components;

use surface\Component;

/**
 * 列组件
 * Class Column
 *
 * @package surface\table
 * Author: zsw zswemail@qq.com
 */
class Column extends Component
{

    public function __construct(string $prop, string $label)
    {
        parent::__construct(
            [
                'props' => [
                    'prop'  => $prop,
                    'label' => $label,
                ],
            ]
        );
    }

    /**
     * 插槽组件配置
     *
     * @param \Closure $closure
     *
     * @return $this
     */
    public function scopedProps(\Closure $closure): self
    {
        array_map($closure, $this->scopedSlots);
        return $this;
    }

}
