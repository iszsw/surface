<?php

namespace surface\form\components;

class Objects extends Column
{

    protected $name = 'Object';


    protected function afterFormat(array $data):array
    {
        if (isset($data['props']) && isset($data['props']['rule']))
        {
            $data['props']['rule'] = array_map([$this, 'formatComponent'], $data['props']['rule']);
        }

        return $data;
    }


}
