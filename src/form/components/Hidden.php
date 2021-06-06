<?php

namespace surface\form\components;

class Hidden extends Input
{

    public function __construct($field, $value = '')
    {
        parent::__construct($field, '', $value);
    }


    protected function init(){
        $this->props('type', 'hidden');
        $this->class('hidden');
    }

}
