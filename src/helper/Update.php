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

    protected function createForm(FormAbstract $model)
    {
        if (Helper::isPost() || Helper::isAjax())
        {
            try {
                if (!call_user_func([$model, 'save'])) {
                    throw new \Exception(call_user_func([$model, 'getError']) ?: '操作失败');
                }
            } catch (\Exception $e) {
                return Helper::error($e->getMessage());
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
