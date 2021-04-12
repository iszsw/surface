<?php
/*
 * Author: zsw zswemail@qq.com
 */

namespace surface\helper;

use surface\exception\SurfaceException;
use surface\form\Form;
use surface\Factory;
use surface\Helper;

trait Update
{

    protected function createForm(FormInterface $model)
    {
        if (Helper::isPost() || Helper::isAjax())
        {
            try {
                $params = array_merge($_POST, json_decode(file_get_contents("php://input"), true) ?? []);
                $msg = call_user_func_array([$model, 'save'], $params);
                $code = 1;
                if (true === $msg) {
                    $msg = '操作成功';
                    $code = 0;
                }else if (false === $msg) {
                    $msg = '操作失败';
                }
                throw new SurfaceException($msg,  $code);
            }catch (SurfaceException $e) {
                return $e;
            }
        }

        return Factory::form(
            function (Form $form) use ($model)
            {
                if (method_exists($model, 'init')) {
                    $model->init($form);
                }
                $form->options($model->options());
                $form->columns($model->columns());
            }
        )->view();
    }

}
