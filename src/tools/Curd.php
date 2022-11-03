<?php

namespace surface\tools;

use surface\Document;
use surface\documents\Form;
use surface\documents\Table;
use surface\Functions;
use surface\Surface;

/**
 * 构建curd页面
 *
 * Class Curd
 *
 * @package surface\tools
 */
class Curd
{

    public Surface $surface;

    public Form $form;

    public Table $table;

    public Document $dialog;

    private string $dataVModelName = 'data';

    public function __construct()
    {
        $this->surface = new Surface();
        $this->form = new Form();
        $this->table = new Table();
        $this->dialog = new Document('el-dialog');
        $this->init();
    }

    private function init()
    {
        $this->form->vModel()->vModel(null, $this->dataVModelName);
        $this->table->vModel();
        $this->dialog->vModel(false)->attrs(
            [
                'title'            => '修改',
                'destroy-on-close' => null,// 设置值为null 标签上只显示名字
            ]
        )->appendChild($this->form);
        $this->surface->append($this->table)->append($this->dialog);
    }

    public function table(array $columns, array $options): self
    {
        $this->table->binds(
            [
                "tableColumns" => $columns,
                "tableOptions" => $options,
            ]
        )->attrs(
            [
                ':columns' => 'tableColumns',
                ':options' => 'tableOptions',
            ]
        );

        return $this;
    }

    public function search(array $columns, array $options): self
    {
        $this->table->binds(
            [
                "search" => [
                    "columns" => $columns,
                    "options" => $options,
                ],
            ]
        )->attrs(
            [
                ':search' => 'search',
            ]
        );

        return $this;
    }

    public function form(array $columns, array $options): self
    {
        $this->form->binds(
            [
                "formColumns" => $columns,
                "formOptions" => array_merge(
                    [
                        'row'         => ['justify' => 'start'],
                        'col'         => ['span' => 12],
                        // 提交前返回 false 阻止提交
                        'submitAfter' => \surface\Functions::create("{$this->getDialogApi()} = false;{$this->getTableApi()}.load()", ["data", "res"]),
                        'request'     => [
                            'url'    => '',
                            'method' => 'post',
                        ],
                    ],
                    $options
                ),
            ]
        )->attrs(
            [
                ':columns' => 'formColumns',
                ':options' => 'formOptions',
            ]
        );

        return $this;
    }

    public function getTableApi(): string
    {
        return "Surface.{$this->surface->id()}.{$this->table->getVModel()}.value";
    }

    public function getFormApi(): string
    {
        return "Surface.{$this->surface->id()}.{$this->form->getVModel()}.value";
    }

    public function getDialogApi(): string
    {
        return "Surface.{$this->surface->id()}.{$this->dialog->getVModel()}.value";
    }

    public function getFormDataApi(): string
    {
        return "Surface.{$this->surface->id()}.{$this->form->getVModel($this->dataVModelName)}.value";
    }

    /**
     * 自定义表格修改事件
     *
     * @param  array|string  $request
     * @param $doneRefresh 修改成功之后刷新页面
     *
     * @return array[]
     */
    public function changeEvent($request = '', $doneRefresh = false): array
    {
        $event = [
            'request' => is_array($request) ? $request : ['url' => $request],
        ];

        if ($doneRefresh) {
            $event['after'] = Functions::create("{$this->getTableApi()}.load();", ['prop', 'data', 'res']);
        }

        return $event;
    }

    public function view(): string
    {
        return $this->surface->view();
    }

}
