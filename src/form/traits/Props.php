<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\form\traits;

use surface\form\attribute\Props as PropsAttr;

/**
 * input基类
 *
 * Class Input
 * @package surface\form\components
 * Author: zsw zswemail@qq.com
 */
trait Props
{

    /**
     * @var PropsAttr
     */
    protected $props;

    protected function checkProps($key)
    {
        if (!$this->props instanceof PropsAttr) {
            if ($key instanceof PropsAttr) {
                $this->props = $key;
                return $this;
            } else {
                $this->props = (new PropsAttr());
            }
        }
    }

    public function props($key = '', $val = null)
    {

        $this->checkProps($key);

        if ($key instanceof PropsAttr) {
            $key = $key->getEdited();
        }

        if ($val === null) {
            if ($key === '') {
                return $this->props;
            } elseif (is_string($key)) {
                return $this->props->$key;
            } elseif (is_array($key)) {
                $this->props = ($this->props)($key);
            }
        } else {
            $this->props->$key = $val;
        }

        return $this;
    }

}