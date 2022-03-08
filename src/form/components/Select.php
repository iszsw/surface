<?php

namespace surface\form\components;

class Select extends Column
{

    public function __construct($field, $title = '', $value = '')
    {
        parent::__construct($field, $title, $value ?: '');
    }

    protected $name = 'select';

}
