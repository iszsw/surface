<?php

namespace surface\form\components;

class Arrays extends Column
{

    protected $name = 'array';

    public function __construct($field, $title = '', $value = '')
    {
        parent::__construct($field, $title, $value ?: (object)[]);
    }

    protected function afterFormat(array $config):array
    {
        $config = parent::afterFormat($config);
        if (isset($config['options']))
        {
            $config['options'] = array_map([$this, 'formatComponent'], $config['options']);
        }
        return $config;
    }


}
