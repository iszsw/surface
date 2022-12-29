<?php

namespace surface\components;

use surface\Component;
use surface\Surface;

class Render extends Component
{

    protected function init()
    {
        $this->listen(self::EVENT_VIEW, function (Surface $surface){
            $this->triggerAllSub($this->config->get('props.options'), self::EVENT_VIEW, [$surface]);
        },false);
    }

}

