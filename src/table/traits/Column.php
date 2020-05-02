<?php
/*
 * Author: zsw zswemail@qq.com
 */

namespace surface\table\traits;

use surface\DataTypeInterface;
use surface\exception\SurfaceException;

trait Column
{
    protected $columns = [];

    /**
     * [$table::text($config), $table::password($config)]
     * ['type'=>'text', 'field'=>'aaa', 'title'=>'hello']
     * [['f1'=>'v1', 'f2'=>'v2'], ['f1'=>'v1', 'f2'=>'v2']]
     *
     * @param null $columns
     * @return $this|array
     * @throws SurfaceException
     */
    public function column($columns = null)
    {
        if (null === $columns) {
            return $this->getColumns();
        } else if (is_array($columns)) {
            $columns = $this->checkTableColumn($columns);
            array_walk($columns, [$this, 'column']);
        } elseif (!empty($columns) && $columns instanceof DataTypeInterface) {
            $columns->init($this);
            array_push($this->columns, $columns->getData());
        }else{
            throw new SurfaceException("columns 不是" .DataTypeInterface::class."的实例");
        }

        return $this;
    }


    /**
     * table列格式解析
     * @param array $columns
     *
     * @return array
     */
    public function checkTableColumn(array $columns): array
    {
        foreach ($columns as $k => $v)
        {
            if ($v instanceof DataTypeInterface) {
                continue;
            }
            $field = $k;
            $title = '';
            if (is_string($v)) {
                is_numeric($field) && $field = $v;
                $title = $v;
                $v = [];
            }elseif(is_array($v)){
                if (isset($v['title'])) {
                    $title = $v['title'];
                    unset($v['title']);
                };

                if (isset($v['field'])) {
                    $field = $v['field'];
                };
            }
            $type = 'text';
            if (isset($v['type'])) {
                $type = $v['type'];
                unset($v['type']);
            }

            $type = preg_replace_callback('/_([a-zA-Z])/', function ($match) {
                return strtoupper($match[1]);
            }, $type);

            $type = lcfirst($type);
            $columns[$k] = self::$type($field, $title, $v);
        }
        return $columns;
    }

    public function getColumns()
    {
        return $this->columns;
    }

}