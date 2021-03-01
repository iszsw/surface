<?php

namespace surface\form\components;

class Group extends Column
{

    protected $name = 'Group';

    protected function afterFormat(array $data):array
    {
        if (isset($data['props'])) {
            if (isset($data['props']['rule'])) {
                $data['props']['rule'] = $this->formatComponent($data['props']['rule']);
            }
            if (isset($data['props']['rules'])) {
                $data['props']['rules'] = array_map([$this, 'formatComponent'], $data['props']['rules']);
            }
        }

        return $data;
    }

}
