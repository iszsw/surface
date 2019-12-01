<?php
/*
 * Author: zsw zswemail@qq.com
 */
namespace surface\form\attribute;

use surface\AttrBase;

/**
 * 插件默认配置表
 *
 * 只有一部分 参考 http://form-create.com/components/element/global.html
 *
 * Class Props
 *
 * @package surface\form\attribute
 * Author: zsw zswemail@qq.com
 */
class Props extends AttrBase
{
    protected function attr():array
    {
        return [
//            "type" => null,
//            "maxlength" => null,
//            "minlength" => null,
//            "placeholder" => null,
//            "clearable" => null,
//            "disabled" => null,
//            "size" => null,
//            "prefixIcon" => null,
//            "suffixIcon" => null,
//            "rows" => null,
//            "autosize" => null,
//            "autocomplete" => null,
//            "name" => null,
//            "readonly" => null,
//            "max" => null,
//            "min" => null,
//            "precision" => null,          //[number] 数值精度
//            "controls"=>null,
//            "controlsPosition"=>null,
//            "step" => null,
//            "resize" => null,
//            "autofocus" => null,
//            "form" => null,
//            "label" => null,
//            "tabindex" => null,
//            "action" => null,             //[upload] 图片上传地址
//            "uploadType" => null,         //[upload] 图片上传类型
//            "manageShow" => null,         //bool [upload] 图片管理
//            "validateEvent" => null,
//            "multiple"  => null,          //[select] 多选
//            "multipleLimit"  => null,     //[select] 多选限制 为0不限制
//            "filterable"  => null,        //[select|cascader] 是否可搜索
//            "allowCreate"  => null,       //[select] 是否允许用户创建新条目，需配合 filterable 使用
//            "remote"=> null,              //[select] 是否为远程搜索
//            "activeText"=>null,           //[switch] switch打开时的文字描述
//            "inactiveText"=>null,         //[switch] switch关闭时的文字描述
//            "showAllLevels"=>null,        //[cascader] 输入框中是否显示选中值的完整路径
//            "expandTrigger"=>null,        //[cascader] 次级菜单的展开方式 click / hover
//            "debounce"=>null,             //[cascader] 搜索关键词输入的去抖延迟，毫秒
//            "format"=>null,               //[date|time]
//            "showAlpha"=>null,            //[color] 透明度选择
//            "predefine"=>null,            //string  [color] 预定义颜色
//            "range"=>null,                //bool [slider] 范围
//            "editorUploadUrl"=>null,      //string [editor] 富文本编辑器文件上传位置 如果为空以base64方式存入内容 成功返回['code'=>0,'data'=['url'=>'']]
        ];
    }

}