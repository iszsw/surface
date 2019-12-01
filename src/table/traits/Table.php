<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\table\traits;

use surface\DataTypeInterface;
use surface\helper\Helper;
use surface\table\attribute\Table as TableAttr;

/**
 *
 * Class Input
 * @package Surface\form\type
 * Author: zsw zswemail@qq.com
 */
trait Table
{

    /**
     * @var TableAttr
     */
    protected $table;

    protected function checkTable($key = '')
    {
        if (!$this->table instanceof TableAttr) {
            if ($key instanceof TableAttr) {
                $this->table = $key;
                return $this;
            } else {
                $this->table = (new TableAttr());
            }
        }
    }

    public function table($key = '', $val = null)
    {
        $this->checkTable($key);

        if ($key instanceof TableAttr) {
            $key = $key->getEdited();
        }

        if ($val === null) {
            if ($key === '') {
                return $this->getTable();
            } elseif (is_string($key)) {
                return $this->table->$key;
            } elseif (is_array($key)) {
                $this->table = ($this->table)($key);
            }
        } else {
            $this->table->$key = $val;
        }
        return $this;
    }

    public function getTable()
    {
        $this->checkTable();

        $this->table->columns = $this->column();

        if (count($this->table->topBtn) > 0) {
            $btn = [];
            foreach ($this->table->topBtn as $k => $b) {
                $btn[$k] = $b instanceof DataTypeInterface ? $b->getData() : $b;
            }
            $this->table->topBtn = $btn;
            unset($b, $btn);
        }

        if (count($this->table->operations) > 0) {
            $btn = [];
            foreach ($this->table->operations as $k => $b) {
                $btn[$k] = $b instanceof DataTypeInterface ? $b->getData() : $b;
            }
            $this->table->operations = $btn;
            unset($b, $btn);
        }

        return Helper::filterEmpty($this->table);
    }

}