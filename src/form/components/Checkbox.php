<?php

namespace surface\form\components;

class Checkbox extends Column
{

    protected $name = 'checkbox';

    public function __construct($field, $title = '', $value = '')
    {
        parent::__construct($field, $title, $value ?: []);
    }

}
