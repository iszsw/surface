<?php

$upload_url = '/upload.php';
$manage_url = '/images.php';

// 配置优先级  自定义配置 > 全局配置 > 默认配置

return [
    'table'      => [ // 表格配置
        'props' => [
            'emptyText' => "没有啦，还看！！！！",
        ],
    ],
    'form'       => [ // 表单配置
                      'global' => [
                          'upload' => [
                              'props' => [
                                  'manageUrl'  => $manage_url,    // 文件管理地址
                                  'action'     => $upload_url,    // 文件上传地址
                                  'name'       => "file",
                                  'uploadType' => 'image', // 文件类型 支持image|file
                                  'multiple'   => false,
                                  'maxLength'  => 1,
                                  'multiple'   => false,
                                  'accept'     => "image\/*",
                              ],
                          ],
                          'take'   => [
                              'props' => [
                                  'unique'    => true, // 去重 唯一
                                  'maxLength' => 9,
                              ],
                          ],
                          'range'  => [
                              'props' => [
                                  'range' => true,
                              ],
                          ],
                          'select' => [
                              'props' => [
                                  'multiple'   => true,
                                  'filterable' => true,
                              ],
                          ],
                          'frame'  => [
                              'props' => [
                                  'icon'   => 'el-icon-plus',
                                  'height' => '550px',
                                  'width'  => '976px', // 90%
                              ],
                          ],
                          'editor' => [
                              'props' => [
                                  'theme'           => 'black', // 主题 primary|black|grey|blue
                                  'items'           => null,    // 菜单内容
                                  'editorUploadUrl' => $upload_url,
                                  'editorManageUrl' => $manage_url,
                                  'editorMediaUrl'  => $upload_url,
                                  'editorFlashUrl'  => $upload_url,
                                  'editorFileUrl'   => $upload_url,
                              ],
                          ],
                      ],
    ],
];
