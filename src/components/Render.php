<?php

namespace surface\components;

use surface\Component;
use surface\Surface;

class Render extends Component
{

    protected function init(): void
    {
        $this->listen(self::EVENT_VIEW, function (){
            $this->triggerAllSub($this->config->get('props.columns'), self::EVENT_VIEW, func_get_args());
        },false);
    }

}

