<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\form\type;

use surface\form\FormTypeBase;
use surface\form\Type;

class DatePicker extends FormTypeBase
{

    protected $type = Type::DATE_PICKER;

    public function __construct($field, $title, $value = [], $rule = null)
    {
        parent::__construct();
        $this->rule = $this->createRule($field, $title, $value, $rule);
        $this->props('type', $this->getPropsType());
    }

    public function init($self): void
    {
        if (is_numeric($this->rule->value)) {
            $this->rule->value = date('Y-m-d', $this->rule->value);
        }
    }

    /**
     * year/month/date/dates/week/datetime/datetimerange/daterange
     *
     */
    protected function getPropsType()
    {
        return 'date';
    }
}