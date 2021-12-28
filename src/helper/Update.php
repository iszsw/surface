<?php
/*
 * Author: zsw iszsw@qq.com
 */

namespace surface\helper;

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

        return Builder::form($model)->view();
    }

}
