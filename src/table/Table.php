<?php
/*
 * Author: zsw zswemail@qq.com
 */

namespace surface\table;

use surface\Base;
use surface\DataTypeInterface;


/**
 * Class Build
 *
 * @method type\Text text($field, $title = null, $column = null) static
 * @method type\LongText longText($field, $title = null, $column = null) static
 * @method type\TextEdit textEdit($field, $title = null, $column = null) static
 * @method type\Html html($field, $title = null, $column = null) static
 * @method type\SwitchEdit switchEdit($field, $title = null, $column = null) static
 * @method type\SelectEdit selectEdit($field, $title = null, $column = null) static
 * @method type\In in($field, $title = null, $column = null) static
 * @method type\Button button($type = '', $title = '', $params = [], $faClass = '') static
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
        'text'       => type\Text::class,
        'longText'   => type\LongText::class,
        'textEdit'   => type\TextEdit::class,
        'html'       => type\Html::class,
        'switchEdit' => type\SwitchEdit::class,
        'selectEdit' => type\SelectEdit::class,
        'in'         => type\In::class,
        'button'     => type\Button::class,
    ];

    public function __construct($closure = null, $config = [])
    {
        $this->table($config);
        parent::__construct($closure);
    }

    public function view()
    {
        ob_start();
        require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'template' .DIRECTORY_SEPARATOR.'page.php';
        $html = ob_get_clean();
        return $html;
    }

}

