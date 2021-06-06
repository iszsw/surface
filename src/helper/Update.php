<?php
/*
 * Author: zsw zswemail@qq.com
 */

namespace surface\helper;

use surface\form\Form;
use surface\Factory;
use surface\Helper;

trait Update
{

    protected function createForm(AbstractForm $model)
    {
        if (Helper::isPost() || Helper::isAjax())
        {
            try {
<<<<<<< HEAD
                if (!call_user_func([$model, 'save'])) {
                    throw new \Exception(call_user_func([$model, 'getError']) ?: '操作失败');
                }
            } catch (\Exception $e) {
                return Helper::error($e->getMessage());
=======
                $msg  = call_user_func([$model, 'save']);
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
>>>>>>> 0df92f05daa46f780b739eaf5d880f4f92b55a98
            }
            return Helper::success('操作成功');
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
