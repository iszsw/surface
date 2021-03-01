<?php

namespace surface\test\helper;

use surface\Factory;
use surface\helper\Curd;
use surface\test\form\Form;
use surface\test\form\Search;
use surface\test\form\Table;

require '../vendor/autoload.php';

class Surface
{
    use Curd;

    public function __construct()
    {
        Factory::configure(require 'config.php');
    }

    public function table()
    {
        return $this->createTable(new Table());
    }

    public function search()
    {
        return $this->createForm(new Search());
    }

    public function form(){

        return $this->createForm(new Form());
    }

}

$index = new Surface();

if ($_GET['form'] ?? false)
{
    $surface = $index->form();
} else if ($_GET['search'] ?? false)
{
    $surface = $index->search();
} else
{
    $surface = $index->table();
}

$view = $surface;

echo $view;



