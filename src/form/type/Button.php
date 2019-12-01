<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\form\type;

use surface\form\FormTypeBase;

class Button extends FormTypeBase
{

    public function __construct($config = [])
    {
        parent::__construct();
        $this->rule = (new \surface\form\attribute\Button($config));
    }

}