<?php

$upload_url = '/upload.php';
$manage_url = '/images.php';

// 配置优先级  自定义配置 > 默认配置

return [
    'cdn'   => 'https://cdn.com/static/surface', // 自定义静态资源cdn地址 资源下载 https://github.com/iszsw/surface-src
    'table' => [
        'globals' => [
            'props' => [
                'emptyText' => "没有啦，还看！！！！",
            ],
        ],
    ],
    'form'  => [
        'globals' => [

        ],
    ],
];
