<?php

namespace surface\form\components;

class Editor extends Column
{

    protected $name = 'editor';

    public function created(\surface\form\Form $self)
    {
        $self->addScript(
            [
                '<script src="//cdn.jsdelivr.net/gh/iszsw/surface-src/NKeditor/NKeditor-all.js"></script>',
                '<script src="//cdn.jsdelivr.net/gh/iszsw/surface-src/NKeditor/jquery.min.js"></script>',
            ]
        );
    }

}
