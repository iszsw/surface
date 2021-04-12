<?php

namespace surface\form\components;

class Date extends Column
{

    protected $name = 'date';

    public function init()
    {
        $this->props('format', 'yyyy-MM-dd HH:mm:ss');
    }

}
