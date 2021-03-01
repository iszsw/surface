<?php
/*
 * Author: zsw zswemail@qq.com
 */

namespace surface\form;

use surface\Surface;
use surface\Component;
use surface\form\components\Form as FormComponent;

/**
 *
 * @method components\Column column($field, $title, $value) static
 * @method Component component($config) static 下拉
 *
 * Handler 组件
 * @method components\Input input($field = '', $title = '', $value = '') static
 * @method components\Number number($field = '', $title = '', $value = 0) static
 * @method components\Select select($field = '', $title = '', $value = '') static
 * @method components\Switcher switcher($field = '', $title = '', $value = '') static
 * @method components\Radio radio($field = '', $title = '', $value = []) static
 * @method components\Checkbox checkbox($field = '', $title = '', $value = []) static
 * @method components\Date date($field = '', $title = '', $value = '') static
 * @method components\Time time($field = '', $title = '', $value = '') static
 * @method components\Color color($field = '', $title = '', $value = '') static
 * @method components\Rate rate($field = '', $title = '', $value = '') static
 * @method components\Slider slider($field = '', $title = '', $value = '') static
 * @method components\Editor editor($field = '', $title = '', $value = '') static
 * @method components\Tree tree($field = '', $title = '', $value = '') static
 * @method components\Group group($field = '', $title = '', $value = '') static
 * @method components\Take take($field = '', $title = '', $value = '') static           配合Table做选择 Table的数据中携带_selection参数作为label
 * @method components\Objects objects($field = '', $title = '', $value = '') static
 * @method components\Upload upload($field = '', $title = '', $value = '') static
 *
 * @package surface\table
 * Author: zsw zswemail@qq.com
 */
class Form extends Surface
{

    protected static $components
        = [
            'input'     => components\Input::class,
            'radio'     => components\Radio::class,
            'number'    => components\Number::class,
            'select'    => components\Select::class,
            'switcher'  => components\Switcher::class,
            'checkbox'  => components\Checkbox::class,
            'date'      => components\Date::class,
            'time'      => components\Time::class,
            'color'     => components\Color::class,
            'rate'      => components\Rate::class,
            'slider'    => components\Slider::class,
            'editor'    => components\Editor::class,
            'tree'      => components\Tree::class,
            'group'     => components\Group::class,
            'objects'   => components\Objects::class,
            'upload'    => components\Upload::class,
            'take'    => components\Take::class,
            'column'    => components\Column::class,
            'component' => Component::class,
        ];

    protected function init()
    {
        $this->model(new FormComponent($this->config));

        $this->addStyle(
            [
                '<link href="//cdn.jsdelivr.net/gh/iszsw/surface-src/index.css" rel="stylesheet">'
            ]
        );

        $this->addScript(
            [
                '<script src="//cdn.staticfile.org/vue/2.6.12/vue.js"></script>',
                '<script src="//cdn.staticfile.org/axios/0.19.0-beta.1/axios.min.js"></script>',
                '<script src="//cdn.staticfile.org/element-ui/2.14.1/index.min.js"></script>',
                '<script src="//cdn.jsdelivr.net/gh/iszsw/surface-src/form-create.js"></script>',
                '<script src="//cdn.jsdelivr.net/gh/iszsw/surface-src/surface-form.js"></script>',
            ]
        );
    }

    public function page(): string
    {
        $id      = $this->getId();
        $columns = json_encode($this->getColumns(), JSON_UNESCAPED_UNICODE);
        $form    = json_encode($this->getModel()->format(), JSON_UNESCAPED_UNICODE);
        ob_start();
        include dirname(__FILE__).DIRECTORY_SEPARATOR.'template'.DIRECTORY_SEPARATOR.'page.php';
        $html = ob_get_clean();
        return $html;
    }

}

