<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\form\traits;

use surface\form\attribute\Col as ColAttr;

/**
 *
 * Class Input
 * @package surface\form\type
 * Author: zsw zswemail@qq.com
 */
trait Col
{

    /**
     * @var ColAttr
     */
    protected $col;

    protected function checkCol($key)
    {
        if (!$this->col instanceof ColAttr) {
            if ($key instanceof ColAttr) {
                $this->col = $key;
            } else {
                $this->col = (new ColAttr());
            }
        }
    }

    public function col($key = '', $val = '')
    {
        $this->checkCol($key);

        if ($key instanceof ColAttr) {
            $key = $key->getEdited();
        }

        if ($val === '') {
            if ($key === '') {
                return $this->col;
            } elseif (is_string($key)) {
                return $this->col->$key;
            } elseif (is_array($key)) {
                $this->col = ($this->col)($key);
            }
        } else {
            $this->col->$key = $val;
        }
        return $this;
    }
}