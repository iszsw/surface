<?php
/*
 * Author: zsw zswemail@qq.com
 */

namespace surface\helper;

use surface\Factory;
use surface\table\Table;
use surface\DataTypeInterface;
use surface\exception\SurfaceException;

trait Read
{
    use Condition;

    protected function createTable(TableInterface $model)
    {
        if (Helper::isPost() || Helper::isAjax())
        {
            try {
                throw new SurfaceException('请求成功', 0, call_user_func_array([$model, 'data'], $this->initSearchConditions($model)));
            }catch (SurfaceException $e) {
                return $e;
            }
        }

        return Factory::table(
            function (Table $table) use ($model)
            {
                if (method_exists($model, 'init')) {
                    $model->init($table);
                }
                $table->options($model->options());
                $table->columns($model->columns());
                ($header = $model->header()) && $table->header($header);
                ($pagination = $model->pagination()) && $table->pagination($pagination);
            }
        )->view();
    }

    /**
     * 获取条件
     * @param TableInterface $table
     *
     * @return array
     * Author: zsw zswemail@qq.com
     */
    protected function initSearchConditions(TableInterface $table):array
    {
        $params = array_merge($_POST, json_decode(file_get_contents("php://input"), true) ?? []);
        $page = $params['page'] ?? 1;
        $limit = $params['limit'] ?? 10;
        $sort_field = $params['sort_field'] ?? '';
        $sort_order = $params['sort_order'] ?? '';
        $where = [];
        $order = '';
        if ($sort_field)
        {
            $order = $sort_field.' '.$sort_order;
        }
        return compact('where', 'order', 'page', 'limit');
    }

}
