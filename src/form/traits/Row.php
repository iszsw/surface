<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\form\traits;

use surface\form\attribute\Row as RowAttr;

/**
 * Class Input
 * @package Surface\form\type
 * Author: zsw zswemail@qq.com
 */
trait Row
{

    /**
     * @var RowAttr
     */
    protected $row;

    protected function checkRow($key)
    {
        if (!$this->row instanceof RowAttr) {
            if ($key instanceof RowAttr) {
                $this->row = $key;
            } else {
                $this->row = (new RowAttr());
            }
        }
    }

    public function row($key = '', $val = '')
    {

        $this->checkRow($key);

        if ($key instanceof RowAttr) {
            $key = $key->getEdited();
        }

        if ($val === '') {
            if ($key === '') {
                return $this->row;
            } elseif (is_string($key)) {
                return $this->row->$key;
            } elseif (is_array($key)) {
                $this->row = ($this->row)($key);
            }
        } else {
            $this->row->$key = $val;
        }
        return $this;
    }
}