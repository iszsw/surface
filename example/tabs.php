<?php

require_once __DIR__."/../../../autoload.php";

use surface\Surface;
use surface\Component;
use surface\Document;
use surface\documents\Table;

/**
 * 实现el-tabs
 */
function createTable($name = ''): Table
{
    $table = new Table();
    $table->binds(
        [
            $name.'columns' => [
                (new \surface\components\TableColumn())->props(['label' => '姓名', 'prop' => 'name']),
                (new \surface\components\TableColumn())->props(['label' => '头像', 'prop' => 'avatar'])->children(
                    (new Component(['el' => 'el-image']))->props([':src' => '', 'style' => ["width" => "50px"]])
                ),
                (new \surface\components\TableColumn())->props(['label' => '来自', 'prop' => 'from'])->children(
                    (new \surface\components\Select())->options(['sz' => '深圳', 'cq' => '重庆', 'sc' => '四川', 'bj' => '北京', 'sh' => '上海'])
                ),
            ],
            $name.'options' => [
                'request' => [
                    'url' => '/api/lists.php',
                ],
            ],
        ]
    )->attrs(
        [
            ':columns' => $name.'columns',
            ':options' => $name.'options',
        ]
    );

    return $table;
}

$tabs = new Document("el-tabs");
$tabs->vModel('table1')->appendChild(
    [
        (new Document("el-tab-pane"))->attrs(['label' => "Table1", 'name' => "table1"])->appendChild(
            $table1 = createTable('table1')->attrs([':autoload' => "false"])->vModel()
        ),
        (new Document("el-tab-pane"))->attrs(['label' => "Table2", 'name' => "table2"])->appendChild(
            $table2 = createTable('table2')->attrs([':autoload' => false])->vModel()
        ),
        (new Document("el-tab-pane"))->attrs(['label' => "Table3", 'name' => "table3"])->appendChild(
            $table3 = createTable('table3')->attrs([':autoload' => false])->vModel()
        ),
    ]
);

$surface = new Surface();
$surface->append($tabs);

$surface->setup(\surface\Functions::create("
<script>
Vue.onMounted(() => {
    Vue.watch(()=>data.{$tabs->getVModel()}.value, (val)=>{
        switch(val){
            case 'table1':
                data.{$table1->getVModel()}.value.load({}, true);
                break;
            case 'table2':
                data.{$table2->getVModel()}.value.load({}, true);
                break;
            case 'table3':
                data.{$table3->getVModel()}.value.load({}, true);
                break;
        }
    }, { immediate: true });
});
</script>
", ["data"]));


//dd($surface->display());

echo $surface->view(); // 显示页面


