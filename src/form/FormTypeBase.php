<?php
/*
 * Author: zsw zswemail@qq.com
 */

namespace surface\form;
use surface\DataTypeInterface;
use surface\form\attribute\Rule;
use surface\helper\Helper;


/**
 * 格式化数据
 *
 * Class FormTypeBase
 * @package Surface\form
 * Author: zsw zswemail@qq.com
 */
abstract class FormTypeBase implements DataTypeInterface, \JsonSerializable
{

    use \surface\form\traits\Col;
    use \surface\form\traits\Props;
    use \surface\form\traits\Validate;

    /**
     * 类型
     * @var string
     */
    protected $type;

    /**
     * 规则
     * @var Rule
     */
    protected $rule;

    public function __construct()
    {
        ($config = $this->config()) && $this->props($config);
    }

    /**
     * 创建规则
     *
     *
     * @param        $field
     * @param        $title
     * @param string $value
     * @param null   $rule
     *
     * @return $this
     * Author: zsw zswemail@qq.com
     */
    protected function createRule($field, $title, $value = '', $rule = null)
    {
        if (!$rule instanceof Rule) {
            if (!is_array($rule)) $rule = [];
            $rule = new Rule($rule);
        }
        $rule_data = ['type'=>$this->type, 'field' => $field, 'title' => $title, 'value' => $value];

        return $rule($rule_data);
    }

    public function rule($key = '', $val = '')
    {
        if ($val) {
            $this->rule[$key] = $val;
            return $this;
        }
        return $key ? $this->rule[$key] : $this->rule;
    }

    /**
     * 返回格式化数组
     *
     * @return mixed
     * Author: zsw zswemail@qq.com
     */
    public function getData()
    {
        if (isset($this->rule->col)) {
            $this->col($this->rule->col);
        }
        if (isset($this->rule->props)) {
            $this->props($this->rule->props);
        }
        if (isset($this->rule->validate)) {
            $this->validate($this->rule->validate);
        }
        $this->rule->col = $this->col;
        $this->rule->props = $this->props;
        $this->rule->validate = $this->validate;
        return Helper::filterEmpty($this->rule);
    }

    public function jsonSerialize()
    {
        return $this->getData();
    }

    /**
     * 设置Props默认值
     * Author: zsw zswemail@qq.com
     */
    protected function setPropsDefault(array $data)
    {
        foreach ($data as $k=>$v) {
            if (!$this->props($k)) {
                $this->props($k, $v);
            }
        }
    }

    /**
     * 初始化操作
     *
     * @param Form|\surface\table\Table $self
     * Author: zsw
     */
    public function init($self):void{}

    /**
     * 读取配置 多层继承将覆盖上级配置
     *
     * @return array
     */
    protected function config():array
    {
        $global = Form::global();
        $called = get_called_class();
        $config = $global[strtolower(basename($called))] ?? [];
        $current = get_class();
        $called_parent = get_parent_class(get_called_class());
        while (1){
            if ($called_parent === $current){break;}
            $config = array_merge($global[strtolower(basename($called_parent))] ?? [], $config);
            $called_parent = get_parent_class($called_parent);
        }
        return $config;
    }

}

