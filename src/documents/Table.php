<?php

namespace surface\documents;

use surface\Component;
use surface\Document;
use surface\Surface;

/**
 *
 * table列中需要获取当前列的字段数据 可以使用 {":字段": Functions:create("...", ['filed', 'row', 'prop'])}
 *
 * <s-table :columns="[...]" :options="{...}" :search="{columns: [], options: {}}">
 *      <template #top></template>
 *      <template #header></template>
 *      <template #append></template>
 *      <template #footer></template>
 * </s-table>
 *
 * @package surface\documents
 */
class Table extends Document
{

    protected string $name = 's-table';

    protected function init(){
        $this->listen(self::EVENT_VIEW, function (Surface $surface){
            $columns = $this->bind->get($this->attr->get(":columns"), []);
            foreach ($columns as $column){
                /* @var Component $column */
                $column->trigger(Component::EVENT_VIEW, [$surface, $this]);
            }

            $searchColumns = $this->bind->get($this->attr->get(':search') . ".columns", []);
            foreach ($searchColumns as $column){
                /* @var Component $column */
                $column->trigger(Component::EVENT_VIEW, [$surface, $this]);
            }
        }, false);
    }

}
