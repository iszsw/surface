<?php

require_once __DIR__."/../../../autoload.php";

function dd(...$data){
    array_map('var_dump', $data);die;
}
