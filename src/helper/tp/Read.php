<?php
/*
 * Author: zsw zswemail@qq.com
 */

namespace surface\helper\tp;
use surface\exception\SurfaceException;
use surface\form\Form;
use surface\Surface;
use surface\table\Table;
use surface\DataTypeInterface;

trait Read
{
    use Condition;

    protected function createTable(TableInterface $model)
    {
        if (request()->method() === 'POST')
        {
            try {
                throw new SurfaceException('请求成功', 0, $this->postHandle($model));
            }catch (SurfaceException $e) {
                return $e();
            }
        }
        return Surface::table(
            function (Table $table) use ($model)
            {
                if (method_exists($model, 'init')) {
                    call_user_func([$model, 'init'], $table);
                }

                if($rule = $model->rules()){
                    Form::global(config(version_compare(\think\App::VERSION,'6.0.0','ge') ? 'surface' : 'surface.'));
                    $table->search($rule);
                }
                $table->table($model->defaults());
                $table->column($table->checkTableColumn($model->column()));
            }
        );
    }

    private function postHandle($model)
    {
        return call_user_func_array([$model, 'search'], $this->getSearchConditions($model));
    }

    /**
     * 获取条件
     * @param TableInterface $table
     *
     * @return array
     */
    protected function getSearchConditions(TableInterface $table):array
    {
        $params = array_merge($_POST, json_decode(file_get_contents("php://input"), true) ?? []);
        $page = $params['page'] ?? 1;
        $row_num = $params['row_num'] ?? 10;
        $sort_field = $params['sort_field'] ?? '';
        $sort_order = $params['sort_order'] ?? '';
        $where = [];
        $order = '';
        if ($sort_field)
        {
            $order = $sort_field.' '.$sort_order;
        }

        $rules = $table->rules();
        if ($rules === null) {
            return compact('where', 'order', 'page', 'row_num');
        }

        // pk和主键的自动转化
        $pk = $table->defaults()['pk'] ?? 'id';
        if (!isset($params[$pk]) && isset($params['pk'])) {
            $params[$pk] = $params['pk'];
        }

        foreach ($rules as $rule) {
            if ($rule[1] instanceof DataTypeInterface) {
                $filed = $rule[1]->rule('field');
            }else{
                $filed = $rule[2];
            }
            if (!isset($params[$filed]) || $params[$filed] === '') continue;
            switch ($rule[1]) {
                default:
                    $where[] = $this->condition($rule[0] , $filed, $params[$filed]);
            }
        }
        $where = array_filter($where);
        return compact('where', 'order', 'page', 'row_num');
    }

}