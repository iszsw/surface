<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\form\type;

use surface\form\Type;

class Password extends Input
{

    protected function getPropsType()
    {
        return Type::PASSWORD;
    }

}