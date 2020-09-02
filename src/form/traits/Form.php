<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\form\traits;

use surface\form\attribute\Form as FormAttr;

/**
 *
 * Class Input
 * @package surface\form\components
 * Author: zsw zswemail@qq.com
 */
trait Form
{

    /**
     * @var FormAttr
     */
    protected $form;

    protected function checkForm($key = '')
    {
        if (!$this->form instanceof FormAttr) {
            if ($key instanceof FormAttr) {
                $this->form = $key;
            } else {
                $this->form = (new FormAttr());
            }
        }
    }

    public function form($key = '', $val = '')
    {
        $this->checkForm($key);

        if ($key instanceof FormAttr) {
            $key = $key->getEdited();
        }

        if ($val === '') {
            if ($key === '') {
                return $this->form;
            } elseif (is_string($key)) {
                return $this->form->$key;
            } elseif (is_array($key)) {
                $this->form = ($this->form)($key);
            }
        } else {
            $this->form->$key = $val;
        }
        return $this;
    }

}