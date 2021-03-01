<?php


$page = $_GET['page'] ?? 1;
$limit = $_GET['limit'] ?? 10;

$star = ($page - 1) * 10;
$adds = ['重庆', '北京', '上海', '深圳', '香港'];
$tags = ['干饭人', '打工人', '程序员', '996', '不要怂'];
$data = [];
for ($i = 1; $i <= $limit; $i++)
{
    $id = $i + $star;
    $username = '苹果' . $id;
    $avatar = 'http://q1.qlogo.cn/g?b=qq&nk=191587'.rand(100, 999).'&s=640';
    array_push(
        $data, [
                 'id'       => $id,
                 'avatar'   => $avatar,
                 'vip'      => '<h2>V'.rand(1, 9).'</h2>',
                 'phone'    => '155555555'.rand(10, 99),
                 'address'  => $adds[array_rand($adds)],
                 'status'   => ! rand(0, 1),
                 'tag'      => $tags[array_rand($tags, 1)],
                 'sex'      => rand(1, 3),
                 'username' => $username,
                 '_selection' => '<img src="'.$avatar.'">' . $username,
             ]
    );
}

echo json_encode(
    [
        'code' => 0,
        'msg'  => 'success',
        'data' => [
            'list'  => $data,
            'count' => 800,
        ],
    ], JSON_UNESCAPED_UNICODE
);

