<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\table\components;

use surface\DataTypeInterface;
use surface\helper\Helper;
use surface\table\attribute\Button as ButtonAttr;

class Button implements DataTypeInterface
{

    protected $button;

    /**
     * Button constructor.
     * @param string $type  page|submit|confirm|html|alert
     *
     * refresh                  默认true     成功之后自动刷新
     * autoClose    page有效     默认true     设置为false不自动关闭
     * closeTime    page有效     默认1500(ms) 自动关闭时间
     *
     * @param string $title
     * @param array $params
     * @param string $faClass
     */
    public function __construct($type = '', $title = '', $params = [], $faClass = '')
    {
        $this->button = new ButtonAttr(['type'=>$type, 'title' => $title, 'params' => $params, 'faClass' => $faClass]);
    }

    public function init($self):void{}

    /**
     * 返回格式化数组
     *
     * @return mixed
     * Author: zsw zswemail@qq.com
     */
    public function getData()
    {
        return Helper::filterEmpty($this->button);
    }

}