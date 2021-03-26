<?php

namespace surface\form\components;

class Editor extends Column
{

    protected $name = 'editor';

    public function created(\surface\form\Form $self)
    {
        $self->addScript(
            [
                '<script src="//s.c/static/surface/wangEditor.min.js"></script>',
            ]
        );
    }

}
