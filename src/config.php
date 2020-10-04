<?php
/**
 * @author zsw zswemail@qq.com
 *
 * 默认值配置文件
 *
 * 类型名称小写 upload|colorpicker
 *
 * 继承关系的插件将覆盖上级，组件中使用props方法中添加的配置优先
 *
 * 配置值为空将读取系统默认配置
 */

$upload_url = '上传文件url';
$manage_url = '管理文件url';

return [
    'static_url' => '//s.zsw.ink', // 设置静态资源访问地址 '//s.zsw.ink',
    'form'       => [ // 表单配置
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
                          'range' => true, // 范围
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
                          'items'           => null,    // 显示的菜单项 null表示所有都显示
                          'editorUploadUrl' => $upload_url,
                          'editorManageUrl' => $manage_url,
                          'editorMediaUrl'  => $upload_url,
                          'editorFlashUrl'  => $upload_url,
                          'editorFileUrl'   => $upload_url,
                      ],
    ],
];