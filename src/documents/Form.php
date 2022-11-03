<?php

namespace surface\documents;

use surface\Component;
use surface\Document;
use surface\Surface;

class Form extends Document
{

    protected string $name = 's-form';

    protected function init(){
        $this->listen(self::EVENT_VIEW, function (Surface $surface){
            $columns = $this->bind->get($this->attr->get(":columns"), []);
            foreach ($columns as $column){
                /* @var Component $column */
                $column->trigger(Component::EVENT_VIEW, [$surface, $this]);
            }
        }, false);
    }

}

