<?php
/**
 * @author zsw zswemail@qq.com
 *
 * 默认值配置文件
 *
 * 类型名称必须小写 upload|colorpicker
 *
 * 继承关系的插件将覆盖上级
 *
 * 配置值为空将读取系统默认配置
 */

$upload_url = '图片上传地址';
$manage_url = '图片管理地址';

return [
    'upload'  => [
        'manageShow' => true,    // 图片管理
        'manageUrl'  => $manage_url,    // 文件管理地址
        'action'     => $upload_url,    // 文件上传地址
        'uploadType' => 'image', // 文件类型 支持image|file
        'multiple'   => false,
        'limit'      => 1,
    ],
    'uploads' => [ // uploads继承自upload 将覆盖upload配置
        'multiple' => true,
        'limit'    => 9,
    ],
    'range'   => [
        'range' => true,
    ],
    'selects' => [
        'multiple'   => true,
        'filterable' => true,
    ],
    'frame'   => [
        'icon'   => 'el-icon-plus',
        'height' => '550px',
        'width'  => '976px', // 90%
    ],
    'editor'  => [
        'theme'           => 'black', // 主题 primary|black|grey|blue
        'items'           => null,    // 菜单内容
        'editorUploadUrl' => $upload_url,
        'editorManageUrl' => $manage_url,
        'editorMediaUrl'  => $upload_url,
        'editorFlashUrl'  => $upload_url,
        'editorFileUrl'   => $upload_url,
    ],
];