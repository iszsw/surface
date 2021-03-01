<?php

namespace surface;

/**
 * Table Form 模型
 *
 * @package surface\model\traits
 * Author: zsw zswemail@qq.com
 */
trait ModelTrait
{

    /**
     * @var Component
     */
    protected $model;

    /**
     * @param Component $model
     */
    public function model(Component $model)
    {
        $this->model = $model;
    }

    /**
     * @param        $key
     * @param string $val
     *
     * @return $this
     */
    public function options($key, $val = ''): self
    {
        if (is_array($key)) {
            foreach ($key as $k => $v) {
                $this->options($k, $v);
            }
        }else{
            $this->model->$key($val);
        }

        return $this;
    }

    /**
     * @return Component
     */
    public function getModel()
    {
        return $this->model;
    }


}
