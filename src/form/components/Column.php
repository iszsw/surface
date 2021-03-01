<?php

namespace surface\form\components;

use surface\Component;

/**
 *
 * @method $this type($value)
 * @method $this class($class)
 * @method $this row($key, $value)
 * @method $this form($key, $value)
 * @method $this col($key, $value)
 * @method $this options(array $options)
 * @method $this control(array $controls) [ ['value'=>1,'rule'=>[]], ['handle'=>'value > 1', 'rule'=>[]] ] handle(表达式 (val当前值) || 值)
 * @method $this suffix(Component $component)
 * @method $this prefix(Component $component)
 * @method $this validate(array $validate)
 *
 * @package surface\table
 * Author: zsw zswemail@qq.com
 */
class Column extends Component
{

    protected $name = 'input';

    public function __construct($field, $title = '', $value = '')
    {
        parent::__construct(
            [
                'type' => $this->name,
                'field' => $field,
                'title' => $title,
                'value' => $value,
            ]
        );
    }

    /**
     * 添加注释 注释和suffix冲突
     *
     * @param string $html
     *
     * @return $this
     */
    public function marker( string $html ):self
    {
        /** @var $component $this */
        $component = new Component;
        $this->suffix($component->type('span')->class('s-marker')->domProps(['innerHTML' => $html]));
        return $this;
    }

    protected function afterFormat(array $config): array
    {
        foreach (['control', 'suffix', 'prefix'] as $type) {
            if (isset($config[$type]))
                switch ($type){
                    case 'control':
                        foreach ($config[$type] as &$control) {
                            $control['rule'] = array_map([$this, 'formatComponent'], $control['rule']);
                        }
                        unset($control);
                        break;
                    case 'prefix':
                    case 'suffix':
                        $config[$type] = $this->formatComponent( $config[$type] );
                        break;
                    default:
                }
        }
        return $config;
    }

}
