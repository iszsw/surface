<?php
/*
 * Author: zsw zswemail@qq.com
 */

namespace surface\form;

use surface\Base;
use surface\DataTypeInterface;
use surface\form\components;
use surface\form\attribute\Button;


/**
 * Class Build
 *
 * @method components\Input input($field = '', $title = '', $value = '', $rule = []) static
 * @method components\Text text($field = '', $title = '', $value = '', $rule = []) static
 * @method components\Json json($field = '', $title = '', $value = '', $rule = []) static
 * @method components\Textarea textarea($field = '', $title = '', $value = '', $rule = []) static
 * @method components\Password password($field = '', $title = '', $value = '', $rule = []) static
 * @method components\Hidden hidden($field = '', $title = '', $value = '', $rule = []) static
 * @method components\Button button($title = '', $rule = []) static
 * @method components\Radio radio($field = '', $title = '', $value = '', $rule = []) static
 * @method components\Checkbox checkbox($field = '', $title = '', $value = [], $rule = []) static
 * @method components\Number number($field = '', $title = '', $value = '', $rule = []) static
 * @method components\Select select($field = '', $title = '', $value = [], $rule = []) static
 * @method components\Selects selects($field = '', $title = '', $value = [], $rule = []) static
 * @method components\Switcher switcher ($field = '', $title = '', $value = [], $rule = []) static
 * @method components\Cascader cascader($field = '', $title = '', $value = [], $rule = []) static
 * @method components\City city($field = '', $title = '', $value = [], $rule = []) static
 * @method components\Area area($field = '', $title = '', $value = [], $rule = []) static
 * @method components\DatePicker date($field = '', $title = '', $value = [], $rule = []) static
 * @method components\TimePicker time($field = '', $title = '', $value = [], $rule = []) static
 * @method components\Datetime datetime($field = '', $title = '', $value = [], $rule = []) static
 * @method components\ColorPicker color($field = '', $title = '', $value = [], $rule = []) static
 * @method components\Rate rate($field = '', $title = '', $value = [], $rule = []) static
 * @method components\Slider slider($field = '', $title = '', $value = [], $rule = []) static
 * @method components\Range range($field = '', $title = '', $value = [], $rule = []) static
 * @method components\Tree tree($field = '', $title = '', $value = [], $rule = []) static
 * @method components\Frame frame($field = '', $title = '', $value = [], $rule = []) static
 * @method components\Upload upload($field = '', $title = '', $value = [], $rule = []) static
 * @method components\Uploads uploads($field = '', $title = '', $value = [], $rule = []) static
 * @method components\Editor editor($field = '', $title = '', $value = '', $rule = []) static
 * @method components\Tab tab($field = '', $title = '', $value = '', $rule = []) static
 *
 * @package surface\form
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
            '<script src="/static/surface/form/form.js"></script>'
        ];

    protected $style = [];

    protected $theme = 'element';

    protected $themes = [
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
            'input'     => components\Input::class,
            'text'     => components\Text::class,
            'json'     => components\Json::class,
            'textarea' => components\Textarea::class,
            'password' => components\Password::class,
            'button'   => components\Button::class,
            'hidden'   => components\Hidden::class,
            'radio'    => components\Radio::class,
            'number'   => components\Number::class,
            'checkbox' => components\Checkbox::class,
            'select'   => components\Select::class,
            'selects'   => components\Selects::class,
            'switcher' => components\Switcher::class,
            'cascader' => components\Cascader::class,
            'city'     => components\City::class,
            'area'     => components\Area::class,
            'colorPicker' => components\ColorPicker::class,
            'datetime'    => components\Datetime::class,
            'date'  => components\DatePicker::class,
            'time'     => components\TimePicker::class,
            'color'    => components\ColorPicker::class,
            'rate'     => components\Rate::class,
            'slider'   => components\Slider::class,
            'range'   => components\Range::class,
            'tree'     => components\Tree::class,
            'frame'    => components\Frame::class,
            'upload'   => components\Upload::class,
            'uploads'   => components\Uploads::class,
            'editor'   => components\Editor::class,
            'tab'   => components\Tab::class,
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
    public function page(): string
    {
        ob_start();
        include dirname(__FILE__).DIRECTORY_SEPARATOR.'template'
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

