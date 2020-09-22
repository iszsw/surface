<?php

require '../vendor/autoload.php';

if (isset($_GET['type'])) {
    echo \surface\test\Test::table();die;
}

if (isset($_GET['from'])) {
    echo \surface\test\Test::images();die;
}
echo \surface\test\Test::form();

