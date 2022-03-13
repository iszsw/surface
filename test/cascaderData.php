<?php


$value = $_GET['value'] ?? '';

$separator = '/'; //分隔符对应 props 的 separator

$values = array_filter(explode($separator, $value));

$count = count($values);

$data = [];

function add(&$data, $val, $label, $child = true) {
    $item = ['value' =>$val, 'label' => $label];
    if ($child) $child ? $item['children'] = [] : '';
    $data[] = $item;
}

$maxLength = 2;

if ($count <= $maxLength) {
    add($data,'BJ' . $count, '北京' . $count, $count < $maxLength);
    add($data,'CQ' . $count, '重庆' . $count, $count < $maxLength);
    add($data,'CD' . $count, '成都' . $count, $count < $maxLength);
}


echo json_encode(
    [
        'code' => 0,
        'msg'  => 'success',
        'data' => [
            'list'  => $data,
        ],
    ], JSON_UNESCAPED_UNICODE
);

