<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\form\components;

use surface\form\Form;
use surface\form\FormTypeBase;
use surface\form\Type;

class Frame extends FormTypeBase
{

    protected $type = Type::FRAME;

    public function __construct($field, $title, $value = [], $rule = null)
    {
        parent::__construct();
        $this->props('handleIcon', true);
        $this->rule = $this->createRule($field, $title, $value, $rule);
    }

    /**
     *
     * @param $self Form
     * Author: zsw zswemail@qq.com
     */
    public function init($self):void
    {
        $self->addScript(
            [
                '<script src="'.$self->getStaticUrl().'/surface/form/components/frame.js"></script>',
            ]
        );
    }


}