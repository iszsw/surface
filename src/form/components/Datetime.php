<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\form\components;

class Datetime extends DatePicker
{

    protected function getPropsType()
    {
        return 'datetime';
    }


    public function init($self): void
    {
        if (is_numeric($this->rule->value)) {
            $this->rule->value = date('Y-m-d H:i:s', $this->rule->value);
        }
    }

}