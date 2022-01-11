<p align="center"><img src="https://z3.ax1x.com/2021/06/29/Rdtqde.png" alt="surface" width="200px" style="border-radius: 50%" /></p>
<h1 align="center" style="margin: 30px 0 30px; font-weight: bold;">
    Surface</h1>
<h4 align="center">低代码PHP页面构建器，快速构建后台Table、Form页面</h4>
<p align="center">
    <img src="https://img.shields.io/badge/License-MIT-yellow.svg" alt="MIT" />
  <a href="https://github.com/iszsw">
    <img src="https://img.shields.io/badge/Author-iszsw-blue.svg" alt="iszsw" />
  </a>
  <a href="https://packagist.org/packages/iszsw/surface">
    <img src="https://img.shields.io/packagist/v/iszsw/surface.svg" alt="surface" />
  </a>
  <a href="https://packagist.org/packages/iszsw/surface">
    <img src="https://img.shields.io/packagist/php-v/iszsw/surface.svg" alt="php version" />
  </a>
</p>

## 特性

- 低代码
- 面向对象风格
- 自定义主题样式
- 动态生成Form页面
- 动态生成Table页面
- 丰富的表格表单样式
- 高扩展性，快速友好的扩展自定义的组件样式

## 内置功能
### table

>  - Button     按钮（submit提交按钮、异步提交按钮，确认按钮，创建子页面按钮，空按钮-自定义点击事件）
>  - Editable   允许编辑
>  - Expand     展开
>  - Select     下拉选择
>  - Selection  复选框
>  - Switcher   开关
>  - Writable   在线编辑

### form

>  - Input      输入框
>  - Number     数字
>  - Checkbox   多选
>  - Radio      单选
>  - Switch     开关
>  - Select     下拉选择
>  - Cascader   联动（同步、异步）
>  - Color      颜色
>  - Date       日期（日期时间，范围）
>  - Time       时间（范围）
>  - Rate       评分
>  - Slider     滑块
>  - Upload     上传
>  - Tree       树
>  - Take       获取（从iframe子页面获取内容到当前字段）
>  - Arrays     无限级数组（嵌套任意form内容）
>  - Component  自定义组件（自定义组件注册调用）

## 演示

[http://curd.demo.zsw.ink/](http://curd.demo.zsw.ink/) 

账号密码 admin  123123


## 源码地址

gitee地址(主推)：[https://gitee.com/iszsw/surface](https://gitee.com/iszsw/surface)

github地址：[https://github.com/iszsw/surface](https://github.com/iszsw/surface)

## 生态

thinkPHP6 **0代码**生成CURD页面 [iszsw/curd](https://gitee.com/iszsw/curd)

Admin极速开发后台 [iszsw/surface-admin](https://gitee.com/iszsw/surface-admin)

## 文档

[https://www.kancloud.cn/iszsw/surface/](https://www.kancloud.cn/iszsw/surface/)


## 安装

```bash
# 运行环境要求 PHP7.1+ || PHP8.0+
composer require iszsw/surface
```

 > 测试代码

```php
<?php
// Table组件示例
$tbales = [
    new selection("id"),
    (new Column('id', '普通组件'))->props('width', '50px'),
    (new Expand('address', '折叠'))->scopedSlots(
        [
            (new Component())->el('span')
                // 【重要】将当前列字段address的值注入innerHTML，需要注入到多个属性使用 Array
                ->inject('domProps', 'innerHTML') 
                ->style('width', '80px'),
        ]
    ),
    (new Column('status', '开关组件'))->scopedSlots(
                [
                    //支持url替换 {字段}替换成当前列参数
                    (new Switcher())->props(['async' => ['data' => ['id', 'a' => 'b'], 'method' => 'POST', 'url' => '/change/{id}/{username}']]),
                ]
            )->props('width', '150px'),

    (new Column('thumbnail', '自定义显示内容'))->scopedSlots(
                [
                    (new Component())->el('el-image')->inject('attrs', ['src', 'array.preview-src-list'])->style('width', '80px'),
                ]
            )->props('width', '100px'),
    
    (new Column('options', '操作'))->props('fixed', 'right')// 右侧浮动
        ->scopedSlots(
            [
                (new Button('el-icon-delete', '删除'))
                    // 【重要】当前列_delete_visible的值为true时才显示按钮
                    ->visible('_delete_visible')
                    //支持url替换 {字段}替换成当前列参数
                    ->createConfirm('确认删除数据？', ['method' => 'DELETE', 'data' => ['id'], 'url' => 'delete/{id}']),
            ]
        ),
];
// Form组件示例
$form = [
    (new Input('username', '用户名'))
        ->input('username', '用户名', '用户名必须填，必须！必须！必须！')
        ->marker('要不得')
        ->validate( // 验证 支持页面验证+后台验证
            [
                ['required' => true, 'message' => '用户名必须'],
            ]
        )
        // 无限级嵌套子组件
        ->children([(new Component)->el('span')->item(false)->domProps(['innerText' => '元'])->slot('append')]),
    (new Hidden('Hidden', '说明')),
    (new Number('price', '价格'))->props('step', 5),
    (new Select('hobby', '爱好'))->select('hobby', '爱好')->options(self::formatOptions([1 => '干饭', '打麻将', '睡觉', '爬山']))->props('multiple', ! 0),
    (new Checkbox('label', '标签', []))->checkbox('label', '标签', [])
        ->options(self::formatOptions([1 => '干饭', '打麻将', '睡觉', '爬山']))
        ->props('max', 2)->props('group', ! 0), //group = true button样式  false 普通样式
    (new Radio('examine', '审核', 2))->options(self::formatOptions([1 => '干饭', '打麻将', '睡觉', '爬山']))
        ->props('group', ! 1), //group = true button样式  false 普通样式
    new Switcher('postage', '包邮', 0),
    (new Date('section_day', '日期'))->props(
        [
            'type'         => "datetimerange",
            'value-format' => "yyyy-MM-dd HH:mm:ss",
        ]
    ),
    (new Time('section_time', '时间'))->props(
        [
            'isRange'      => ! 0,
            'value-format' => "HH:mm:ss",
        ]
    ),
    new Color('color', '颜色', '#333333'),
    new Rate('rate', '评分', 2),
    (new Slider('slider', '范围', [15, 27]))->props(['min' => 10, 'max' => 30, 'range' => ! 0]),
    (new Tree('tree', '树'))->props(
        [
            'type'              => 'checked',
            'defaultExpandAll'  => ! 0,
            'checkOnClickNode'  => ! 0,
            'expandOnClickNode' => ! 1,
            'multiple'          => ! 0,
            'showCheckbox'      => ! 0,
            'data'              => [
                [
                    'id'       => 1,
                    'title'    => 'a',
                    'expand'   => ! 0,
                    'selected' => ! 1,
                    'children' => [
                        [
                            'id'       => 101,
                            'title'    => 'a1',
                            'expand'   => ! 0,
                            'children' => [
                                [
                                    'id'    => 10101,
                                    'title' => 'a11',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'props'             => ['label' => 'title'],
        ]
    ),
    new Editor('content', '说明', '<h1>666</h1>'),
    (new Number('pricea', '我是惊喜', 2))->marker('惊不惊喜')->props('step', 5)
        ->visible([['prop' => 'priceb', 'value' => 10],]), // 字段显示条件配置
    (new Number('priceb', '价格', 8))->marker('把我加到10有惊喜'),
];


// 自定义组件和全局事件绑定
$mixin = <<<JS
<script>
    // 全局混入事件
    Vue.mixin({
            methods: {
                hello() {
                    alert("全局混入事件")
                    // \$surfaceForm 是surfaceForm API对象
                    \$surfaceForm.change(this.prop, 'ok')
                }
            }
        })
        
    // 自定义组件 注册world组件
    surfaceForm.component({
        name: 'world',
        events: {
            // 参数初始化时（组件未注册）调用
            onInit(c) {
                console.log('surfaceForm自定义组件配置初始化')
            }
        },
        component: {
            name: 'world',
            props: {
                label: String,
                prop: String,
                value: [String],
                model: Object
            },
            render(h) {
                return h("el-button", {
                    on: {
                        click() {
                            alert('surfaceForm组件注册')
                        }
                    }
                }, this.value)
            }
        }
    })
</script>
JS;

// 注册js资源
$form->addScript($mixin);

// 点击事件绑定hello方法
$form->column('button','绑定事件','')->el('el-button')->on('click', 'hello')->children(["全局混入事件"]),
$form->column('world','自定义组件','surface-form自定义world组件')->el('world'),

```

 > 更多功能演示

基础功能[演示 /test/index.php](/test/index.php) 

内置封装的[助手工具演示 /test/helper.php](/test/helper.php) 

## 关于

> **邮件** iszsw@qq.com
>
> **主页**  [https://zsw.ink](https://zsw.ink) 留言


## 说明

前端基于 [iszsw/surface-src](https://gitee.com/iszsw/surface-src) 

如果需要自定义后端开发 可以自行引入前端逻辑

## 演示图

> Table组件

![6jcp11.png](https://z3.ax1x.com/2021/07/03/R2TIij.png)

> Form 组件

![6jcp11.png](https://z3.ax1x.com/2021/03/26/6jcp11.png)
