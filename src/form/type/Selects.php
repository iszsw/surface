<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\form\type;

class Selects extends Select
{

    public function __construct($field, $title, $value = [], $rule = null)
    {
        parent::__construct($field, $title, $value, $rule);
    }

}