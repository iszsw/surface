<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\form\type;

use surface\form\Type;

class Textarea extends Input
{

    protected function getPropsType()
    {
        return Type::TEXTAREA;
    }

}