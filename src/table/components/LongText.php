<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\table\components;

use surface\table\TableTypeBase;
use surface\table\Type;

class LongText extends TableTypeBase
{

    protected $type = Type::LONG_TEXT;

    public function __construct($field, $title = null, $column = null)
    {
        parent::__construct($field, $title, $column);

        $this->column->length = 10;
    }

}