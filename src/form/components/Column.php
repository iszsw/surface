<?php

namespace surface\form\components;

use surface\Component;

/**
 *
 * @method $this el($el) 组件名
 * @method $this label($label) 标题
 * @method $this prop($prop) field参数
 * @method $this value($value) 值
 * @method $this options(array $options) 附加参数
 * @method $this item($item) Component|false|(Object)[]  Component参数无需定义el名称 props，class，children...
 * @method $this validate(array $validate) 校验
 * @method $this visible(array $visible) 显示条件（AND） [ ['value'=>1,'prop'=>'字段'], ['prop'=>'', 'exec'=>'val === 1'], ['exec' => 'model.field === 1']] exec js表达式
 *
 * @package surface\table
 * Author: zsw zswemail@qq.com
 */
class Column extends Component
{

    protected $name = 'input';

    public function __construct($prop, $label = '', $value = '')
    {
        parent::__construct(
            [
                'el' => $this->name,
                'prop' => $prop,
                'label' => $label,
                'value' => $value
            ]
        );
    }

    /**
     * 添加表单注释
     *
     * @param string $html
     * @param string $type  innerHTML | innerText
     *
     * @return $this
     */
    public function marker( string $html , $type = 'innerHTML'):self
    {
        if (!$this->item) $this->item(new Component);
        $children = $this->item->children ?? [];
        array_push($children, (new Component)->el('div')->class('s-marker')->domProps([$type == 'innerHTML' ? $type : 'innerText' => $html]));
        $this->item->children($children);
        return $this;
    }

    protected function afterFormat(array $config): array
    {
        foreach (['item'] as $type) {
            if (isset($config[$type]))
                switch ($type){
                    case 'item':
                        $config[$type] = $this->formatComponent( $config[$type] );
                        break;
                    default:
                }
        }
        if (!isset($config['item']) && $this->label) $config['item'] = (Object)[];
        return $config;
    }

}
