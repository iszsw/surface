<?php

namespace surface\form\components;

use surface\Factory;
use surface\Surface;

class Editor extends Column
{

    protected $name = 'editor';

    public function created(\surface\form\Form $self)
    {
        $self->addScript(
            [
                '<script src="'.Factory::configure('cdn', Surface::CDN_DOMAIN).'/wangEditor/wangEditor.min.js"></script>',
            ]
        );
    }

}
