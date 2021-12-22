<?php

$upload_url = '/upload.php';
$manage_url = '/images.php';

// 配置优先级  自定义配置 > 默认配置

return [
    //'cdn'   => '//b.s.c/static/surface',// 静态资源cdn地址
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
