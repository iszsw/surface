<?php

namespace surface\helper;

use surface\Component;
use surface\components\Button;
use surface\components\Form;
use surface\components\Popconfirm;
use surface\components\Table;
use surface\Functions;
use surface\Surface;

/**
 * curd助手类
 *
 * @package surface\helper
 */
trait Curd
{

    /**
     * table绑定的全局双向对象名称
     *
     * @var string
     */
    protected string $tableRef = 'tableRef';

    /**
     * form绑定的全局双向对象名称
     *
     * @var string
     */
    protected string $formRef = 'formRef';

    /**
     * form绑定的全局双向对象名称
     *
     * @var string
     */
    protected string $formDataRef = 'formDataRef';

    /**
     * 表单dialog绑定的全局双向对象名称
     *
     * @var string
     */
    protected string $dialogRef = 'dialogRef';

    protected Surface $surface;


    public function getSurface(): Surface
    {
        if (!isset($this->surface)) {
            $this->surface = new Surface();

            $this->surface->addStyle("<style>.surface-container{padding: 10px}.s-table .title {font-size: 24px;color: #000;margin-right: 10px}.s-table .describe {font-size: 15px;color: #888}</style>", 3);
        }

        return $this->surface;
    }

    /**
     * @return string|Component
     */
    protected function title(): string|Component
    {
        return '';
    }

    /**
     * @return string|Component
     */
    protected function describe() : string|Component
    {
        return '';
    }

    /**
     * 表格列项
     *
     * @return array<Component>
     */
    protected function tableColumns(): array
    {
        return [];
    }

    /**
     * 表格配置
     *
     * props： el-table props配置 https://element-plus.gitee.io/zh-CN/component/table.html
     * request： array
     * paginationProps ： array
     * loadAfter： Functions
     *
     * @return array<Component>
     */
    protected function tableOptions(): array
    {
        return [
            'request' => ['url' => ""],
            'paginationProps' => ['page-size' => 1]
        ];
    }

    /**
     * 搜索列
     *
     * @return array<Component>
     */
    protected function searchColumns(): array
    {
        return [];
    }

    /**
     * 搜索配置
     *
     * props： el-form props配置 https://element-plus.gitee.io/zh-CN/component/form.html
     *
     * @return array<Component>
     */
    protected function searchOptions(): array
    {
        return [
            'props'        => ['label-width' => 0],
            "row"          => ["gutter" => 10],
            "col"          => ['span' => 4],
            "submit"       => ['children' => "搜索", 'props' => ['type' => 'primary']],
            "reset"        => ['children' => "重置"],
            'submitBefore' => Functions::create("{$this->getTableApi()}.load(data, true);return false", ['data']),
        ];
    }

    /**
     * 表单列
     *
     * @return array<Component>
     */
    protected function formColumns(): array
    {
        return [];
    }

    /**
     * 表单配置
     *
     * props： el-form props配置 https://element-plus.gitee.io/zh-CN/component/form.html
     * row: el-row
     * col: el-col
     * submitBefore: Functions
     * submitAfter: Functions
     * validate: Functions 字段校验失败回调
     * request: axios提交配置
     * submit: 提交按钮 不需要可以设置为null
     * reset: 重置按钮
     *
     * @return array<Component>
     */
    protected function formOptions(): array
    {
        return [];
    }

    /**
     * dialog的显示和隐藏
     *
     * @return string
     */
    protected function getDialogApi(): string
    {
        return "{$this->getSurface()->data()}.{$this->dialogRef}.value";
    }

    /**
     * dialog的显示和隐藏
     *
     * @return string
     */
    protected function getTableApi(): string
    {
        return "{$this->getSurface()->data()}.{$this->tableRef}.value";
    }

    /**
     * 表单数据
     *
     * @return string
     */
    protected function getFormData(): string
    {
        return "{$this->getSurface()->data()}.{$this->formDataRef}.value";
    }

    /**
     * 表单父级dialog配置
     *
     * @return array
     */
    protected function formDialogProps(): array
    {
        return [
            'title'            => '操作',
            'destroy-on-close' => true,
            'width'            => '500px',
        ];
    }


    /**
     * 表格顶部标题
     *
     * @param  string|Component  $title
     * @param  string|Component  $describe
     *
     * @return Component|null
     */
    protected function buildTitle(string|Component $title = '', string|Component $describe = ''): ?Component
    {
        $children = [];
        if ($title) {
            $children[] = $title instanceof Component ? $title : (new Component("span"))->props('class', "title")->children($title);
        }
        if ($describe) {
            $children[] = $describe instanceof Component ? $describe : (new Component("span"))->props('class', "describe")->children($describe);
        }

        return count($children) ? (new Component('div'))->props(['style' => "margin-bottom:20px"])->children($children) : null;
    }

    protected function buildSearch(): ?Form
    {

        if (count($searchColumns = $this->searchColumns()) < 1) {
            return null;
        }

        return (new Form())
            ->props(
                [
                    'columns' => $searchColumns,
                    'options' => $this->searchOptions(),
                ]
            );
    }

    /**
     * 构建表格
     *
     * @return Table
     */
    protected function buildTable(): Table
    {
        $children = [];

        if ($title = $this->buildTitle($this->title(), $this->describe())) {
            $children[] = $title->slot('top');
        }

        if ($search = $this->buildSearch()) {
            $children[] = $search->slot('header');
        }

        return (new Table())
            ->vModel(name: $this->tableRef)
            ->props(
                [
                    'columns' => $this->tableColumns(),
                    'options' => $this->tableOptions(),
                ]
            )->children($children);
    }

    /**
     * 构建表单
     *
     * @return Component
     */
    protected function buildForm(): Component
    {
        $form = (new Form())
            ->vModel(name: $this->formRef)
            ->vModel([], 'data', $this->formDataRef)
            ->props(
                [
                    'columns' => $this->formColumns(),
                    'options' => array_merge($this->formOptions(), [
                        'submitAfter' => Functions::create(
                            "
ElementPlus.ElMessage({type: 'success',message: res.msg || '成功'});
{$this->getDialogApi()} = false;
{$this->getTableApi()}.load();
                        ", ['data', 'res']
                        )
                    ]),
                ]
            );

        return (new Component('el-dialog'))
            ->vModel(false, name: $this->dialogRef)
            ->props($this->formDialogProps())
            ->children($form);
    }

    protected function build(): void
    {
        $this->getSurface()->append($this->buildTable());

        $this->getSurface()->append($this->buildForm());
    }

    /**
     * 生成页面
     *
     * @return string
     */
    public function view(): string
    {
        $this->build();

        return $this->getSurface()->view();
    }

    //代码片段
    /**
     * @param  array<Component|string>|string|Component  $children
     *
     * @return Component
     */
    protected function reloadBtn($children = null): Component
    {
        return (new Component('button'))
            ->props(
                [
                    "type"    => "info",
                    "onClick" => Functions::create($this->getTableApi().'.load()'),
                ]
            )->children($children ?: [(new Component('icon'))->props(['icon' => 'Refresh'])]);
    }

    /**
     * @param array<Component|string>|string|Component $children
     *
     * @return Component
     */
    protected function addBtn($children = null): Component
    {
        return (new Component('button'))
            ->props(
                [
                    "type"    => "primary",
                    "onClick" => Functions::create($this->getFormData()." = {};{$this->getDialogApi()} = true;"),
                ]
            )->children($children ?: [(new Component('icon'))->props(['icon' => 'Plus'])]);
    }

    protected function deleteBtn($url = '{id}', $btn = '删除', string $confirmMsg = '确认删除？'): Component
    {
        return (new Popconfirm())
            ->props(['title' => $confirmMsg])
            ->onConfirm(is_array($url) ? $url : ["url" => $url, 'method' => 'DELETE'], $this->getTableApi().'.load()')
            ->reference($btn, "danger");
    }

    protected function editBtn($children = '编辑'): Component
    {
        return (new Button())->props(
            [
                'type'     => 'primary',
                'link'     => true,
                // 通过:注入当前列到方法
                ':onClick' => Functions::create(
                    "
                    return function(){
                       {$this->getFormData()} = Surface.cloneDeep(row)
                       {$this->getDialogApi()} = true
                    } ",
                    ['filed', 'row']
                ),
            ]
        )->children($children);
    }

}
