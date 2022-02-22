<?php

$upload_url = '/upload.php';
$manage_url = '/images.php';

// 配置优先级  自定义配置 > 默认配置

return [
    'cdn'   => '', // 自定义静态资源cdn地址 资源下载 https://github.com/iszsw/surface-src
    'table' => [
        'globals' => [
            'props' => [
                'emptyText' => "没有啦，还看！！！！",
            ],
        ],
        'style'   => [ // 全局公共样式
        ],
        'script'  => [ // 全局公共js
        ],
    ],
    'form'  => [
        'globals' => [

        ],
        'style'   => [ // 全局公共样式
        ],
        'script'  => [ // 全局公共js
        ],
    ],
];
