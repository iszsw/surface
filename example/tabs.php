<?php

require_once "common.php";

use surface\components\Table;
use surface\Surface;
use surface\Component;

/**
 * 实现el-tabs
 */
function createPane($name = ''): Component
{
    return (new Component('el-tab-pane'))->props(['label' => $name, 'name' => $name])
        ->children(
            (new Table())->vModel(name: $name)->props(
            [
                'columns' => [
                    (new \surface\components\TableColumn())->props(['label' => '姓名', 'prop' => 'name']),
                    (new \surface\components\TableColumn())->props(['label' => '头像', 'prop' => 'avatar'])->children(
                        (new Component(['el' => 'el-image']))->props([':src' => '', 'style' => ["width" => "50px"]])
                    ),
                    (new \surface\components\TableColumn())->props(['label' => '来自', 'prop' => 'from'])->children(
                        (new \surface\components\Select())->options(['sz' => '深圳', 'cq' => '重庆', 'sc' => '四川', 'bj' => '北京', 'sh' => '上海'])
                    ),
                ],
                'options' => [
                    'request' => [
                        'url' => '/api/lists.php',
                    ],
                ],
            ]
        )
        );
}

$tabs = (new Component('el-tabs'))->vModel('table1', name: "tabRef")->children(
    [
        createPane('table1'),
        createPane('table2'),
        createPane('table3'),
    ]
);

$surface = new Surface();
$surface->setup(\surface\Functions::create("
<script>
Vue.onMounted(() => {
    Vue.watch(()=>data.tabRef.value, (val)=>{
        data[val].value.load({}, true);
    });
});
</script>
", ["data"]));


echo $tabs->view($surface);


