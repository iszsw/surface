<?php
/*
 * Author: zsw zswemail@qq.com
 */

namespace surface\form\traits;

use surface\AttrBase;
use surface\DataTypeInterface;

/**
 *
 * Class Input
 * @package surface\form\components
 * Author: zsw zswemail@qq.com
 */
trait Rule
{

    /**
     * 规则
     *
     * @var null
     */
    protected $rules = [];

    /**
     * [$form::text($config), $form::password($config)]
     * ['type'=>'input', 'field'=>'aaa', 'title'=>'hello', 'props'=>['type'=>'text']]
     * [['f1'=>'v1', 'f2'=>'v2'], ['f1'=>'v1', 'f2'=>'v2']]
     *
     * @param null $rules
     * @return $this|null
     * Author: zsw zswemail@qq.com
     */
    public function rule($rules = null)
    {
        if (null === $rules) {
            return $this->getRules();
        }
        if (is_array($rules)) {
            foreach ($rules as $k => $rule) {
                if (is_array($rule)) {
                    $rule['field'] = $rule['field'] ?? $k;
                }
                $rule = $this->createFormItem($rule, $this);
                call_user_func([$this, 'rule'], $rule);
            }
        } elseif (!empty($rules) && $rules instanceof AttrBase) {
            array_push($this->rules, $rules);
        }
        return $this;
    }

    /**
     * @param $data
     * @param $self
     * @param bool $getData 获取Data
     * @return mixed
     * Author: zsw zswemail@qq.com
     */
    public static function createFormItem($data, $self, $getData = true)
    {
        if (!$data instanceof DataTypeInterface) {
            $type = $data['type'] ?? 'text';
            $field = $data['field'] ?? '';
            $title = $data['title'] ?? '';
            $options = $data['options'] ?? '';
            $value = $data['value'] ?? '';
            $children = $data['children'] ?? [];
            unset($data['type'], $data['field'], $data['title'], $data['value'], $data['options'], $data['children']);
            switch ($type) {
                case 'uploads':
                    $value = json_decode($value, true);
                    break;
            }
            $item = static::$type($field, $title, $value, $data);
            if ($options && method_exists($item, 'addOptions')) {
                $item->addOptions($options);
            }
        } else {
            $item = $data;
            $children = $item->rule('children');
        }
        if (count($children) > 0) {
            $children_values = [];
            foreach ($children as $k => $v) {
                if (is_array($v)) {
                    $v['field'] = $v['field'] ?? $k;
                    $v['name'] = $v['name'] ?? $v['field'];
                }
                $children_values[] = static::createFormItem($v, $self, $getData);
            }
            $children = $children_values;
            $item->rule('children', $children);
        }
        if ($item && method_exists($item, 'init')) {
            $item->init($self);
        }
        return ($item && $getData) ? $item->getData() : $item;
    }

    public function getRules()
    {
        return $this->rules;
    }
}