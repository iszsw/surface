<?php
/*
 * Author: zsw zswemail@qq.com
 */

namespace surface\table;

use surface\Base;
use surface\table\components;


/**
 * Class Build
 *
 * @method components\Text text($field, $title = null, $column = null) static
 * @method components\LongText longText($field, $title = null, $column = null) static
 * @method components\TextEdit textEdit($field, $title = null, $column = null) static
 * @method components\Html html($field, $title = null, $column = null) static
 * @method components\SwitchEdit switchEdit($field, $title = null, $column = null) static
 * @method components\SelectEdit selectEdit($field, $title = null, $column = null) static
 * @method components\In in($field, $title = null, $column = null) static
 * @method components\Button button($type = '', $title = '', $params = [], $faClass = '') static
 *
 * @package surface\table
 * Author: zsw zswemail@qq.com
 */
class Table extends Base
{

    use \surface\table\traits\Table;
    use \surface\table\traits\Column;
    use \surface\table\traits\Search;

    protected $style = [
        '<link href="/static/surface/table/table.css" rel="stylesheet">',
        '<link href="//cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">',
    ];

    protected $script = [
        '<script src="//cdn.staticfile.org/vue/2.6.10/vue.js"></script>',
        '<script src="//cdn.staticfile.org/axios/0.19.0-beta.1/axios.min.js"></script>',
        '<script src="//cdn.staticfile.org/sweetalert/2.1.2/sweetalert.min.js"></script>',
        '<script src="/static/surface/table/table.js"></script>',
    ];


    protected static $servers = [
        'text'       => components\Text::class,
        'longText'   => components\LongText::class,
        'textEdit'   => components\TextEdit::class,
        'html'       => components\Html::class,
        'switchEdit' => components\SwitchEdit::class,
        'selectEdit' => components\SelectEdit::class,
        'in'         => components\In::class,
        'button'     => components\Button::class,
    ];

    public function __construct($closure = null, $config = [])
    {
        $this->table($config);
        parent::__construct($closure);
    }

    public function page(): string
    {
        ob_start();
        include dirname(__FILE__).DIRECTORY_SEPARATOR.'template' .DIRECTORY_SEPARATOR.'page.php';
        $html = ob_get_clean();
        return $html;
    }

}

