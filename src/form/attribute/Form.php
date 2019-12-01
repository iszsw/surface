<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\form\attribute;

use surface\AttrBase;

class Form extends AttrBase
{
    protected function attr():array
    {
        return [
            "inline"=> false,               //bool   [*] 行内标签
            "labelPosition"=> 'right',      //string [*] label位置
            "labelSuffix"=> null,           //string [ele] title后缀
            "hideRequiredAsterisk"=> false, //bool   [ele] 隐藏*（Required）
            "labelWidth"=> '100px',         //int    [*] label宽度
            "showMessage"=> true,           //bool   [*] 显示错误提示
            "inlineMessage"=> false,        //bool   [*] 显示行内错误
            "statusIcon"=> true,            //bool   [ele] 错误时表单显示错误图标
            "validateOnRuleChange"=> false, //bool   [ele]
            "disabled"=> false,             //bool   [ele] 禁止表单
            "size"=> 'large',               //string [*] default、small、large。
        ];
    }

}