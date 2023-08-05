<?php

namespace surface\components;

class Hidden extends Input
{

    protected string $name = 'input';

    protected function init(): void
    {
        parent::init();
        $this->config->set(['item' => null, 'props' => ['type' => 'hidden']]);
    }

}

