<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\table;

use surface\DataTypeInterface;
use surface\helper\Helper;
use surface\table\attribute\Column;


/**
 * 格式化数据
 *
 * Interface HtmlInterface
 *
 * @package Surface
 * Author: zsw zswemail@qq.com
 */
abstract class TableTypeBase implements DataTypeInterface
{

    /**
     * 类型
     * @var string
     */
    protected $type;

    protected $column;

    public function __construct($field, $title = null, $column = null)
    {
        $this->column = $this->createColumns($field, $title === null ? $field: $title, $column);
    }

    protected function createColumns($field, $title, $column = null)
    {
        if (!$column instanceof Column) {
            $column = new Column($column);
        }
        $rule_data = ['type'=>$this->type, 'field' => $field, 'title' => $title];

        return $column($rule_data);
    }

    public function init($self):void{}

    /**
     * 返回格式化数组
     *
     * @return mixed
     * Author: zsw zswemail@qq.com
     */
    public function getData()
    {
        return Helper::filterEmpty($this->column);
    }

    public function __call($name, $arguments)
    {
        if (empty($arguments)) {
            return $this->column->$name;
        }
        $this->column->$name = $arguments[0];
        return $this;
    }

}

