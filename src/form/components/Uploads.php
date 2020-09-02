<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\form\components;

class Uploads extends Upload
{
    public function __construct($field, $title, $value = [], $rule = null)
    {
        parent::__construct($field, $title, $value, $rule);
    }
}