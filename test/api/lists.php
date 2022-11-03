<?php

$data = [];
$page = $_GET['page'] ?? 1;
$limit = $_GET['limit'] ?? 10;

$from = ['sz', 'cq', 'sc', 'bj', 'sh'];
$address = ['辽宁省 大连市 西岗区', '福建省 莆田市 荔城区', '澳门特别行政区 澳门半岛', '北京 北京市 顺义区', '黑龙江省 鹤岗市 南山区'];

for($i = 1; $i<=$limit; $i++){
    $data[] = [
        'id' => ($page - 1) * $limit + $i,
        'name' => "No." . (($page - 1) * $limit + $i),
        'age' => rand(15, 40),
        'status' => !rand(0, 1),
        'from' => $from[array_rand($from)],
        'address' => $address[array_rand($address)],
        'avatar' => "https://zos.alipayobjects.com/rmsportal/jkjgkEfvpUPVyRjUImniVslZfWPnJuuZ.png"
    ];
}

echo json_encode(
    [
        'code' => 0,
        'msg' => 0,
        'data' => [
            'total' => 123,
            'data' => $data
        ],
    ],JSON_UNESCAPED_UNICODE);

