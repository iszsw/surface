<?php

namespace surface\components;

use surface\Component;
use surface\Surface;

/**
 * 自定义的Table组件
 *
 * props
 *  - columns array<Component> 表单项
 *  - options array            全局和el-form的props配置
 *
 * @package surface\components
 */
class Form extends Component
{

    protected function init(): void
    {
        $this->listen(self::EVENT_VIEW, function (){
            $this->triggerAllSub($this->config->get('props.columns'), self::EVENT_VIEW, func_get_args());
        },false);
    }

}

