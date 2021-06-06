<?php

namespace surface\form\components;

class Time extends Column
{

    protected $name = 'time';

    protected function init()
    {
        $this->props('format', 'HH:mm:ss');
    }

}
