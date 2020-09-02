<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\form\components;

class Range extends Slider
{

    public function __construct($field, $title, $value = [], $rule = null)
    {
        parent::__construct($field, $title, $value, $rule);
    }

}