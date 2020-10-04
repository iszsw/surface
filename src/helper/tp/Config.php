<?php

namespace surface\helper\tp;

use surface\form\Form;

trait Config
{

    protected static function registerConfig()
    {
        Form::global(config(version_compare(\think\App::VERSION,'6.0.0','ge') ? 'surface' : 'surface.'));
    }

}