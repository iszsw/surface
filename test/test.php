<?php

require_once __DIR__ . "/../../../autoload.php";

use surface\Surface;

/**
 * 自定义Document
 */

$surface = new Surface();
$id = $surface->id();

$document = new \surface\Document("div");
$document->attrs(["title" => "name1"])
    ->appendChild(
        (new \surface\Document('el-button'))
            ->attrs(["title" => "按钮"])
            ->attrs([":class" => "clb"])
            ->attrs(["@click" => "tab"]) // 绑定click触发tab方法

            ->binds(["clb" => "按钮"])
            ->binds(["tab" => \surface\Functions::create('console.log("Hello World")')]) // 绑定tab方法

            ->appendChild(":clb") // 绑定内容为 clb
    );

$surface->append($document);

echo $surface->view();

