<?php
/*
 * Author: zsw zswemail@qq.com
 */

namespace surface\form;

use surface\Surface;
use surface\Component;
use surface\form\components\
{
    Column,
    Input,
    Hidden,
    Number,
    Select,
    Checkbox,
    Switcher,
    Date,
    Time,
    Color,
    Rate,
    Slider,
    Tree,
    Editor,
    Upload,
    Radio,
    Take,
    Cascader,
    Arrays
};

/**
 *
 * @method Component component($config) static
 * @method Column column($prop, $label, $value) static
 * @method Input input($prop, $label = '', $value = '') static
 * @method Hidden hidden($prop, $value = '') static
 * @method Number number($prop, $label = '', $value = '') static
 * @method Radio radio($prop, $label = '', $value = '') static
 * @method Select select($prop, $label = '', $value = '') static
 * @method Checkbox checkbox($prop, $label = '', $value = []) static
 * @method Switcher switcher($prop, $label = '', $value = '') static
 * @method Date date($prop, $label = '', $value = '') static
 * @method Time time($prop, $label = '', $value = '') static
 * @method Color color($prop, $label = '', $value = '') static
 * @method Rate rate($prop, $label = '', $value = '') static
 * @method Slider slider($prop, $label = '', $value = '') static
 * @method Tree tree($prop, $label = '', $value = '') static
 * @method Editor editor($prop, $label = '', $value = '') static
 * @method Upload upload($prop, $label = '', $value = '') static
 * @method Take take($prop, $label = '', $value = '') static
 * @method Cascader cascader($prop, $label = '', $value = '') static
 * @method Arrays arrays($prop, $label = '', $value = '') static
 *
 * Handler 组件
 *
 * @package surface\table
 * Author: zsw zswemail@qq.com
 */
class Form extends Surface
{

    protected static $components
        = [
            'component' => Component::class,
            'column' => Column::class,
            'input' => Input::class,
            'hidden' => Hidden::class,
            'number' => Number::class,
            'select' => Select::class,
            'checkbox' => Checkbox::class,
            'switcher' => Switcher::class,
            'date' => Date::class,
            'time' => Time::class,
            'color' => Color::class,
            'slider' => Slider::class,
            'rate' => Rate::class,
            'tree' => Tree::class,
            'editor' => Editor::class,
            'upload' => Upload::class,
            'radio' => Radio::class,
            'take' => Take::class,
            'cascader' => Cascader::class,
            'arrays' => Arrays::class,
        ];

    public function page(): string
    {
        $options     = $this->getGlobals()->format();
        $options     = json_encode(count($options) > 0 ? $options : (object)[], JSON_UNESCAPED_UNICODE);
        $columns     = json_encode($this->getColumns(), JSON_UNESCAPED_UNICODE);
        $search      = $this->search();

        ob_start();
        include dirname(__FILE__).DIRECTORY_SEPARATOR.'template'.DIRECTORY_SEPARATOR.'page.php';
        return ob_get_clean();
    }

}

