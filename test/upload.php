<?php


echo json_encode(
    [
        'code' => 0,
        'msg'  => 'success',
        'data' => [
            'url'  => 'http://q1.qlogo.cn/g?b=qq&nk=191587'.rand(100, 999).'&s=640',
        ],
    ], JSON_UNESCAPED_UNICODE
);

