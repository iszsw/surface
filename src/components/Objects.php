<?php

namespace surface\components;

use surface\Surface;

/**
 * 对象组件
 *
 * props
 *  - columns array<Component> 项
 *  - row   array objects组件外层row组件配置
 *
 * @package surface\components
 */
class Objects extends FormColumn
{

    protected function init()
    {
        parent::init();
        $this->listen(self::EVENT_VIEW, function (Surface $surface){
            $this->triggerAllSub($this->config->get('props.columns'), self::EVENT_VIEW, [$surface]);
        },false);
    }

}

