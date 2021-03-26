<?php

namespace surface\table\components;

use surface\Component;

/**
 * 创建一个按钮组件
 *
 * Class Button
 *
 * @package surface\table\components
 * Author: zsw zswemail@qq.com
 */
class Button extends Component
{

    protected $name = 's-button';

    /**
     * 打开页面
     */
    const HANDLER_PAGE = 'page';

    /**
     * 确认框
     */
    const HANDLER_CONFIRM = 'confirm';

    /**
     * 重新拉取数据
     */
    const HANDLER_REFRESH = 'refresh';

    /**
     * header 提交选中
     */
    const HANDLER_SUBMIT = 'submit';


    public function __construct($icon = 'el-icon-s-tools', $tooltip = '查看')
    {
        parent::__construct(
            [
                'el'    => $this->name,
                'props' => [
                    'prop'       => [
                        'type' => 'text',
                        'icon' => $icon,
                    ],
                    'tooltip'    => $tooltip,
                    'confirmBtn' => false,
                    'cancelBtn'  => false,
                ],
            ]
        );
    }

    /**
     * 根据 '行字段' 判断是否禁用该行使用按钮
     * 行按钮有效
     *
     * @param $field
     *
     * @return Button
     */
    public function visible($field){
        return $this->props('visible', $field);
    }

    /**
     * @param       $url    地址
     * @param array $data   请求扩展参数
     *
     * @return Button
     */
    public function createPage($url, array $data = [])
    {
        return $this->props(
            is_array($url)
                ? $url
                : [
                'handler' => self::HANDLER_PAGE,
                'url'     => $url,
                'data'    => $data,
            ]
        );
    }

    /**
     * @param       $confirmMsg 点击提示文字
     * @param array $async      异步提交地址
     *
     * @return Button
     */
    public function createConfirm($confirmMsg, array $async = [])
    {
        return $this->props(
            is_array($confirmMsg)
                ? $confirmMsg
                : [
                'handler'    => self::HANDLER_CONFIRM,
                'confirmMsg' => $confirmMsg,
                'async'      => $async,
            ]
        );
    }

    /**
     * 刷新
     *
     * @return Button
     */
    public function createRefresh()
    {
        return $this->props(['handler' => self::HANDLER_REFRESH]);
    }

    /**
     *
     * @param array  $async      异步提交地址
     * @param string $confirmMsg 提示文字
     * @param string $pk         提交的主键
     *
     * @return Button
     */
    public function createSubmit(array $async = [], string $confirmMsg = '', string $pk = 'id')
    {
        return $this->props(
            [
                'handler'    => self::HANDLER_SUBMIT,
                'confirmMsg' => $confirmMsg,
                'async'      => $async,
                'pk'         => $pk,
            ]
        );
    }


}


