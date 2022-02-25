<?php
/*
 * Author: zsw iszsw@qq.com
 */

namespace surface\helper;

use surface\Helper;
use surface\DataTypeInterface;

trait Read
{

    use Condition;

    protected function createTable(TableAbstract $model)
    {
        if (Helper::isPost() || Helper::isAjax())
        {
            try {
                return Helper::success('请求成功', call_user_func_array([$model, 'data'], self::initSearchConditions($model)));
            }catch (\Exception $e) {
                return Helper::error($e->getMessage());
            }
        }

        return Builder::table($model)->view();
    }

    /**
     * 获取条件
     * @param TableAbstract $table
     *
     * @return array
     * Author: zsw iszsw@qq.com
     */
    public static function initSearchConditions(TableAbstract $table):array
    {
        $params = array_merge($_POST, $_GET, json_decode(file_get_contents("php://input"), true) ?? []);
        $page = $params['page'] ?? 1;
        $limit = $params['limit'] ?? 10;
        $sort_field = $params['sort_field'] ?? '';
        $sort_order = $params['sort_order'] ?? '';
        $where = [];
        $rules = ($form = $table->search()) ? $form->rules() : [];
        array_walk($params, function ($v, $k) use (&$where, $rules) {
            if (!in_array($k, ['page', 'limit', 'sort_field', 'sort_order']) && $v !== '') {
                $where[] = self::condition($rules[$k] ?? '=', $k, $v);
            }
        }, $where);
        $order = $sort_field ? $sort_field.' '.$sort_order : '';
        return compact('where', 'order', 'page', 'limit');
    }

}
