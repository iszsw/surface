<?php

require_once __DIR__ . "/../../../autoload.php";

/**
 * 自定义Document
 */

//初始化surface容器
$surface = new \surface\Surface();

// 创建一个div标签
$document = (new \surface\Document("div"))
    //添加属性 title="name"
    ->attrs(["title" => "name"])
    // div内部加入标签
    ->appendChild(
        [
            // 直接使用html标签
            "<h1>Hello world</h1>",

            // Document生成标签
            // <el-button title="按钮" :class="clb" @click="tab">按钮</el-button>
            (new \surface\Document('el-button'))
                ->attrs(
                    [
                        "title" => "按钮",
                        ":class" => "className", // 动态绑定
                        "@click" => "btnTab", // 绑定事件
                    ])
                ->binds(
                    [
                        "ref:className" => "hello", // 通过ref绑定参数 ref|reactive
                        "btnText" => "按钮",
                        "btnTab" => \surface\Functions::create('console.log("Hello World")') // 自定义函数
                    ])
                ->appendChild(":btnText")
        ]
    );

// 将文档加入到容器中
$surface->append($document);

$document->listen(\surface\Document::EVENT_VIEW, function (\surface\Surface $surface){
    // 调用 $surface->view() 时触发
});

// 显示生成的代码（不包含静态资源）不同页面可以混合使用
// echo $surface->display();

// 生成页面
echo $surface->view();

