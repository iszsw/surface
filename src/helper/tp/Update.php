<?php
/*
 * Author: zsw zswemail@qq.com
 */

namespace surface\helper\tp;

use surface\form\Form;
use surface\Surface;

trait Update
{

    protected function createForm(FormInterface $model)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return call_user_func([$model, 'save']);
        }

        //注册配置
        Form::global(config(version_compare(\think\App::VERSION,'6.0.0','ge') ? 'surface' : 'surface.'));

        return Surface::form(
            function (Form $form) use ($model)
            {
                $form->rule($model->column());
                ($config = $model->defaults()) && $form->setConfig($config);
            }
        );
    }

}