<?php

namespace surface\form\components;

class Slider extends Column
{

    protected $name = 'slider';

    public function init()
    {
        $this->style('minWidth', '100px');
    }

}
