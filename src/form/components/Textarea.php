<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\form\components;

use surface\form\Type;

class Textarea extends Input
{

    protected function getPropsType()
    {
        return Type::TEXTAREA;
    }

}