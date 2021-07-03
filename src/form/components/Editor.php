<?php

namespace surface\form\components;

use surface\Surface;

class Editor extends Column
{

    protected $name = 'editor';

    public function created(\surface\form\Form $self)
    {
        $self->addScript(
            [
                '<script src="'.Surface::CDN_DOMAIN.'/wangEditor.min.js"></script>',
            ]
        );
    }

}
