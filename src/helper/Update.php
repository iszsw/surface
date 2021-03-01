<?php
/*
 * Author: zsw zswemail@qq.com
 */

namespace surface\helper;

use surface\exception\SurfaceException;
use surface\form\Form;
use surface\Factory;

trait Update
{

    protected function createForm(FormInterface $model)
    {
        if (Helper::isPost() || Helper::isAjax())
        {
            try {
                $params = array_merge($_POST, json_decode(file_get_contents("php://input"), true) ?? []);
                $msg = call_user_func_array([$model, 'save'], $params);
                if (is_bool($msg)) {
                    $msg === true ? '操作成功' : '操作失败';
                }
                throw new SurfaceException($msg,  (int)$msg);
            }catch (SurfaceException $e) {
                return $e;
            }
        }

        return Factory::form(
            function (Form $form) use ($model)
            {
                $form->options($model->options());
                $form->columns($model->columns());
            }
        )->view();
    }

}
