<?php

require_once "common.php";

use surface\Component;
use surface\Functions;
use surface\components\Table;
use surface\components\Render;
use surface\components\TableColumn;


// render组件的用法 json字符串的组件生成页面
$table = (new Table())
    ->props(
        [
            'columns' => [
                (new TableColumn())->props(['type' => 'selection']),
                (new TableColumn())->props(['label' => '头像', 'prop' => 'avatar'])->children(
                    (new Component(['el' => 'el-image']))->props([':src' => '', 'style' => ["width" => "50px"]])
                ),
                (new TableColumn())->props(['label' => '地址'])->children(
                    [
                        (new TableColumn())->props(['label' => '地址', 'minWidth' => "160px", 'prop' => 'address']),
                        (new TableColumn())->props(['label' => '收货人', 'prop' => 'name']),
                    ]
                )
            ],
            'options' => [
                'config'          => [
                    'responseKeys'        => [
                        'code' => 'code',
                        'data' => 'data',
                        'msg'  => 'msg',
                    ],
                    'responseSuccessCode' => 0,
                ],
                'request'         => [
                    'url'  => '/api/lists.php'
                ],
                'loadAfter' => Functions::create("console.log('加载完成...')", ['res'])
            ]
        ]
    );

$json = json_encode($table, JSON_UNESCAPED_UNICODE);

$render = (new Render())->props(['columns' => json_decode($json, true)]);

echo $render->view();

