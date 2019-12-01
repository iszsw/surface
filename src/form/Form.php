<?php
/*
 * Author: zsw zswemail@qq.com
 */

namespace surface\form;

use surface\Base;
use surface\DataTypeInterface;
use surface\form\type\Button;


/**
 * Class Build
 *
 * @method type\Input input($field = '', $title = '', $value = '', $rule = []) static
 * @method type\Text text($field = '', $title = '', $value = '', $rule = []) static
 * @method type\Json json($field = '', $title = '', $value = '', $rule = []) static
 * @method type\Textarea textarea($field = '', $title = '', $value = '', $rule = []) static
 * @method type\Password password($field = '', $title = '', $value = '', $rule = []) static
 * @method type\Hidden hidden($field = '', $title = '', $value = '', $rule = []) static
 * @method type\Button button($title = '', $rule = []) static
 * @method type\Radio radio($field = '', $title = '', $value = '', $rule = []) static
 * @method type\Checkbox checkbox($field = '', $title = '', $value = [], $rule = []) static
 * @method type\Number number($field = '', $title = '', $value = '', $rule = []) static
 * @method type\Select select($field = '', $title = '', $value = [], $rule = []) static
 * @method type\Selects selects($field = '', $title = '', $value = [], $rule = []) static
 * @method type\Switcher switcher ($field = '', $title = '', $value = [], $rule = []) static
 * @method type\Cascader cascader($field = '', $title = '', $value = [], $rule = []) static
 * @method type\City city($field = '', $title = '', $value = [], $rule = []) static
 * @method type\Area area($field = '', $title = '', $value = [], $rule = []) static
 * @method type\DatePicker Date($field = '', $title = '', $value = [], $rule = []) static
 * @method type\TimePicker time($field = '', $title = '', $value = [], $rule = []) static
 * @method type\Datetime datetime($field = '', $title = '', $value = [], $rule = []) static
 * @method type\ColorPicker color($field = '', $title = '', $value = [], $rule = []) static
 * @method type\Rate rate($field = '', $title = '', $value = [], $rule = []) static
 * @method type\Slider slider($field = '', $title = '', $value = [], $rule = []) static
 * @method type\Range range($field = '', $title = '', $value = [], $rule = []) static
 * @method type\Tree tree($field = '', $title = '', $value = [], $rule = []) static
 * @method type\Frame frame($field = '', $title = '', $value = [], $rule = []) static
 * @method type\Upload upload($field = '', $title = '', $value = [], $rule = []) static
 * @method type\Uploads uploads($field = '', $title = '', $value = [], $rule = []) static
 * @method type\Editor editor($field = '', $title = '', $value = '', $rule = []) static
 * @method type\Tab tab($field = '', $title = '', $value = '', $rule = []) static
 *
 * @package Surface\form
 * Author: zsw zswemail@qq.com
 */
class Form extends Base
{

    use \surface\form\traits\Row;
    use \surface\form\traits\Form;
    use \surface\form\traits\Rule;
    use \surface\form\traits\Globals;

    /**
     * 全局配置
     *
     * @var array
     */
    protected $config = [
            'action' => '',
            'method' => 'post', //ajax提交方式
            'submitBtn' => false,
            'resetBtn' => false,
            'globals' => null,
        ];

    /**
     * 重置按钮配置
     *
     * @var bool
     */
    protected $resetBtn = false;

    protected $script
        = [
            '<script src="//cdn.staticfile.org/axios/0.19.0-beta.1/axios.min.js"></script>',
            '<script src="//cdn.staticfile.org/vue/2.6.10/vue.js"></script>',
            '<script src="/static/surface/form/form.js"></script>',
        ];

    protected $style = [];

    protected $theme = 'element';

    protected $themes
        = [
            'iview'   => [ //TODO iView兼容性待调试
                'style'  => [
                    '<link href="//cdn.staticfile.org/iview/3.4.2-rc.1/styles/iview.css" rel="stylesheet">',
                ],
                'script' => [
                    '<script src="//cdn.staticfile.org/iview/3.4.2-rc.1/iview.min.js"></script>',
                    '<script src="/static/surface/form/form-create.iview.min.js"></script>',
                ],
            ],
            'element' => [
                'style'  => [
                    '<link rel="stylesheet" href="//cdn.staticfile.org/element-ui/2.8.2/theme-chalk/index.css">',
                ],
                'script' => [
                    '<script src="//cdn.staticfile.org/element-ui/2.8.2/index.js"></script>',
//                    '<script src="//unpkg.com/@form-create/element-ui/dist/form-create.min.js"></script>',
                    '<script src="/static/surface/form/form-create.elm.min.js"></script>',
                ],
            ],
        ];

    protected static $servers
        = [
            'input'     => type\Input::class,
            'text'     => type\Text::class,
            'json'     => type\Json::class,
            'textarea' => type\Textarea::class,
            'password' => type\Password::class,
            'button'   => type\Button::class,
            'hidden'   => type\Hidden::class,
            'radio'    => type\Radio::class,
            'number'   => type\Number::class,
            'checkbox' => type\Checkbox::class,
            'select'   => type\Select::class,
            'selects'   => type\Selects::class,
            'switcher' => type\Switcher::class,
            'cascader' => type\Cascader::class,
            'city'     => type\City::class,
            'area'     => type\Area::class,
            'colorPicker' => type\ColorPicker::class,
            'datetime'    => type\Datetime::class,
            'date'  => type\DatePicker::class,
            'time'     => type\TimePicker::class,
            'color'    => type\ColorPicker::class,
            'rate'     => type\Rate::class,
            'slider'   => type\Slider::class,
            'range'   => type\Range::class,
            'tree'     => type\Tree::class,
            'frame'    => type\Frame::class,
            'upload'   => type\Upload::class,
            'uploads'   => type\Uploads::class,
            'editor'   => type\Editor::class,
            'tab'   => type\Tab::class,
        ];


    /**
     * 全局配置
     * @var array
     */
    protected static $global_config = [];

    public static function global($data = null)
    {
        if (is_null($data)) {
            return self::$global_config;
        }elseif (is_string($data)) {
            return self::$global_config[$data] ?? [];
        }elseif (is_array($data)) {
            foreach ($data as $key => $val) {
                if (is_array($val)) {
                    if (!isset(self::$global_config[$key])) {
                        self::$global_config[$key] = $val;
                    }else{
                        self::$global_config[$key] = array_merge(self::$global_config[$key], $val);
                    }
                }
            }
        }
    }

    public function setSubmitBtn($config = [])
    {
        if ($config instanceof Button)
        {
            $this->config['submitBtn'] = $config;
        } elseif ( ! $this->config['submitBtn'] instanceof Button)
        {
            $this->config['submitBtn'] = new Button($config);
        }else
        {
            $this->config['submitBtn']($config);
        }

        return $this;
    }

    public function setResetBtn($config = [])
    {
        if ($config instanceof Button)
        {
            $this->config['resetBtn'] = $config;
        } elseif ( !$this->config['resetBtn'] instanceof Button)
        {
            $this->config['resetBtn'] = new Button($config);
        }else
        {
            $this->config['resetBtn']($config);
        }

        return $this;
    }

    public function setConfig($key, $val = '')
    {
        if (is_array($key)) {
            foreach ($key as $k => $value) {
                call_user_func_array([$this, 'setConfig'], [$k, $value]);
            }
        }else{
            $this->config[$key] = $val;
        }
        return $this;
    }

    public function setTheme($theme)
    {
        $this->theme = $theme;

        return $this;
    }

    public function getStyle()
    {
        $theme_style = $this->themes[$this->theme]['style'];

        return array_merge($this->style, $theme_style);
    }

    public function getScript()
    {
        $theme_script = $this->themes[$this->theme]['script'];

        return array_merge($this->script, $theme_script);
    }

    public function getSubmitBtn()
    {
        return $this->config['submitBtn'] instanceof DataTypeInterface
            ? $this->config['submitBtn']->getData() : $this->config['submitBtn'];
    }

    public function getResetBtn()
    {
        return $this->config['resetBtn'] instanceof DataTypeInterface
            ? $this->config['resetBtn']->getData() : $this->config['resetBtn'];
    }

    /**
     * 获取表单视图
     *
     * @return string
     */
    public function view()
    {
        ob_start();
        require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'template'
            .DIRECTORY_SEPARATOR.'page.php';
        $html = ob_get_clean();
        return $html;
    }

    public function getConstitute()
    {
        return [
            'url'=> $this->getConfig('action'),
            'type'=> $this->getConfig('method'),
            'form'=> $this->form(),
            'row'=> $this->row(),
            'submitBtn'=> $this->getSubmitBtn(),
            'resetBtn'=> $this->getResetBtn()
        ];
    }

    public function getForm()
    {
        return [
            'url'=> $this->getConfig('action'),
            'type'=> $this->getConfig('method'),
            'form'=> json_encode($this->form()),
            'row'=> json_encode($this->row()),
            'submitBtn'=> json_encode($this->getSubmitBtn()),
            'resetBtn'=> json_encode($this->getResetBtn())
        ];
    }

}

