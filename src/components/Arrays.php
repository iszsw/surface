<?php

namespace surface\components;

use surface\Surface;

/**
 * 数组组件
 *
 * props
 *  - columns array<Component> 项
 *  - append bool 允许增加列
 *  - max int 最大列数量
 *
 * @package surface\components
 */
class Arrays extends FormColumn
{

    protected function init()
    {
        parent::init();
        $this->listen(self::EVENT_VIEW, function (){
            $this->triggerAllSub($this->config->get('props.columns'), self::EVENT_VIEW, func_get_args());
        },false);
    }

}

