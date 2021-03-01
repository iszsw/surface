<?php
/*
 * Author: zsw zswemail@qq.com
 */

namespace surface\table;

use surface\Surface;
use surface\Component;
use surface\table\traits;
use surface\table\components;
use surface\table\components\Table as TableComponent;


/**
 * Class Build
 *
 * @method components\Expand expand($prop, $label) static
 * @method components\Selection selection($prop) static
 * @method components\Column column($prop, $label) static
 * @method Component component($config) static     下拉
 *
 * scopedSlots自定义组件
 * @method components\Switcher switcher($prop, $label) static 开关
 * @method components\Writable writable($prop, $label) static 可编辑文本
 * @method components\Select select($prop, $label) static     下拉
 *
 * Handler 组件
 * @method components\Button button($handler, $icon) static
 *
 * @package surface\table
 * Author: zsw zswemail@qq.com
 */
class Table extends Surface
{

    use traits\Header;
    use traits\Pagination;

    protected static $components = [
        'expand' => components\Expand::class,
        'selection' => components\Selection::class,
        'writable'  => components\Writable::class,
        'switcher'  => components\Switcher::class,
        'select'    => components\Select::class,
        'column'    => components\Column::class,
        'Table'     => components\Form::class,
        'button'    => components\Button::class,
        'component' => Component::class,
    ];

    protected function init()
    {
        $this->model(new TableComponent($this->config));

        $this->addStyle([
            '<link href="//cdn.jsdelivr.net/gh/iszsw/surface-src/index.css" rel="stylesheet">',
        ]);

        $this->addScript([
            '<script src="//cdn.staticfile.org/vue/2.6.12/vue.js"></script>',
            '<script src="//cdn.staticfile.org/axios/0.19.0-beta.1/axios.min.js"></script>',
            '<script src="//cdn.staticfile.org/element-ui/2.14.1/index.min.js"></script>',
            '<script src="//cdn.jsdelivr.net/gh/iszsw/surface-src/surface-table.js"></script>',
        ]);
    }

    public function page(): string
    {
        $id      = $this->getId();
        $columns = json_encode($this->getColumns(), JSON_UNESCAPED_UNICODE);
        $table    = json_encode($this->getModel()->format() ?: (object)[], JSON_UNESCAPED_UNICODE);
        $pagination  = $this->getPagination();
        $header  = $this->getHeader();
        $pagination = $pagination ? json_encode($pagination->format(), JSON_UNESCAPED_UNICODE) : 'null';
        $header = $header ? json_encode($header->format(), JSON_UNESCAPED_UNICODE) : 'null';

        ob_start();
        include dirname(__FILE__).DIRECTORY_SEPARATOR.'template'.DIRECTORY_SEPARATOR.'page.php';
        $html = ob_get_clean();
        return $html;
    }

}

