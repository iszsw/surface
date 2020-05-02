<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\form\type;

use surface\form\FormTypeBase;
use surface\form\Type;

class TimePicker extends FormTypeBase
{

    protected $type = Type::TIME_PICKER;

    public function __construct($field, $title, $value = [], $rule = null)
    {
        parent::__construct();
        $this->rule = $this->createRule($field, $title, $value, $rule);
    }

    public function init($self): void
    {
        if (is_numeric($this->rule->value)) {
            $this->rule->value = date('H:i:s', $this->rule->value);
        }
    }

    /**
     * year/month/date/dates/ week/datetime/datetimerange/daterange
     *
     * @param $type
     */
    public function setType($type)
    {
        $this->props('type', $type);
    }

}