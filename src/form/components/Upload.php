<?php

namespace surface\form\components;

class Upload extends Column
{

    protected $name = 'upload';

    protected function init()
    {
        $this->props(['action' => '']);
    }


}
