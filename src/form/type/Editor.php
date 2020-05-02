<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\form\type;

use surface\form\Form;
use surface\form\FormTypeBase;
use surface\form\Type;

class Editor extends FormTypeBase
{

    protected $type = Type::EDITOR;

    public function __construct($field, $title, $value = [], $rule = null)
    {
        parent::__construct();
        $this->rule = $this->createRule($field, $title, $value, $rule);
    }

    /**
     *
     * @param $self Form
     */
    public function init($self):void
    {
        $self->addScript([
                             '<script src="/static/surface/form/NKeditor/NKeditor-all.js"></script>',
                             '<script src="/static/surface/form/NKeditor/jquery.min.js"></script>',
                         ]);
    }

}