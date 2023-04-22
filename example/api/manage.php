<?php

$data = [];
$limit = $_GET['limit'] ?? 10;
for($i = 1; $i<=$limit; $i++){
    $data[] = [
        'name' => $i,
        'size' => rand(500, 1500) . 'KB',
        'url' => "https://zos.alipayobjects.com/rmsportal/jkjgkEfvpUPVyRjUImniVslZfWPnJuuZ.png?t=" . (microtime(true) + $i)
    ];
}

echo json_encode(
    [
        'code' => 0,
        'msg' => 0,
        'data' => [
            'total' => 153,
            'data' => $data,
        ],
    ], JSON_UNESCAPED_UNICODE);

