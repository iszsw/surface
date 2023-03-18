<?php

namespace surface\components;

use surface\Component;

/**
 *
 * @method $this label(string $label)
 * @method $this name(string $name)
 * @method $this value(string|number|array $value)
 * @method $this col(array $col) 布局col
 * @method $this item(?array $item) 外层form-item组件 null关闭外层item
 * @method $this visible(array $visible) 动态显示隐藏 [['name' => 'number1', 'value' => 1]]
 *      1、{name: 'name', value: 'val'}
 *      2、{name: 'name', exec: 'val >= 0'}
 *      3、{exec: 'models.input === "hello"'}
 *      4、function(models){ return models.input === 'hello' }
 *
 * @method $this suffix(string|Component|array $suffix) 组件后缀
 *
 * @package surface\components
 */
class FormColumn extends Component
{

    protected function init(){
        $this->config->set('col', []);
    }

    /**
     * 设置验证规则
     * ['required'=>true, 'message' => '请输入名字2!']
     * [['required'=>true, 'message' => '请输入名字2!'], ['required'=>true, 'message' => '请输入名字2!']]
     *
     * @param array $rules
     *
     * @return $this
     */
    public function rules(array $rules): self
    {
        if (!isset($rules[0])) {
            $rules = [$rules];
        }
        $this->config->set('item', ['rules' => $rules]);
        return $this;
    }

}

