<?php
/*
 * Author: zsw zswemail@qq.com
 */

namespace surface;

use surface\exception\SurfaceException;

trait ColumnTrait
{

    /**
     * @var array<Component>
     */
    protected $columns = [];

    /**
     * 调用created方法 注入this
     *
     * 1、[$table::text(...), ...]
     * 2、['type'=>'text', 'field'=>'aaa', 'title'=>'hello']
     * 3、[['f1'=>'v1', 'f2'=>'v2'], ['f1'=>'v1', 'f2'=>'v2']]
     *
     * @param null|array<Component>|Component $columns
     *
     * @return $this|array
     * @throws SurfaceException
     */
    public function columns($columns = null)
    {
        if (empty($columns))
        {
            return $this->getColumns();
        } else
        {
            if (is_array($columns))
            {
                array_walk($columns, [$this, 'columns']);
            } elseif ($columns instanceof Component)
            {
                if (method_exists($columns, 'created')) $columns->created($this);
                array_push($this->columns, $columns);
            } else
            {
                throw new SurfaceException('Columns must implement interface:'.Component::class);
            }
        }

        return $this;
    }

    public function getColumns($format = true)
    {
        if ($format) {
            $columns = [];
            foreach ($this->columns as $col) {
                /** @var Component $col */
                array_push($columns, $col->format(function (Component $component) {
                    if (method_exists($component, 'created')) $component->created($this);
                }));
            }
            return $columns;
        }else{
            return $this->columns;
        }
    }

}
